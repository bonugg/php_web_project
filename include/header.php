<?php
session_start();

if (isset($_SESSION["userid"]))
$userid = $_SESSION["userid"];
else {
$userid = "";
}

if (isset($_SESSION["username"]))
$username = $_SESSION["username"];
else
$username = "";

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.ico">
<meta charset="utf-8">
<title>BW casino</title>
<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$( document ).ready( function() { /* 버튼 누를 시 슬라이드 동작 스크립트 */
$( 'p0' ).click( function() {
$( '#a' ).animate( {
width: '31.5%'
} );
} );
} );
$( document ).ready( function() {
$( 'p1' ).click( function() {
$( '#a' ).animate( {
width: '0%'
} );
} );
} );
</script>
<link rel="stylesheet" href="../css/style.css">
<style>
body{
overflow:hidden
}
canvas {
    background-image: url("../img/bg.jpg");
    background-size: cover;
    position: relative;
    z-index: -3;
}
.canvas {
    width: 500px;
    height: 500px;
    background-color: black;
    position: relative;
}
/* 큰 모니터 16:9 */
@media screen and (min-width : 1920px) {
    .canvas {
        width: 1920px;
        height:1080px;
    }
}
#a {
width: 0vw;
height: 0vh;
background-color: black;
    position: absolute;
    top : 5%;
}
.menu_st {
color: #ffffff;
font-family: 'Monoton';
background-image: url("../img/1.png");
border-radius: 10px 10px 10px 10px / 10px 10px 10px 10px;
text-align: center;
line-height: 82px;
background-size: cover;
width: 10vw;
height: 8vh;
font-size: 1.2em;
}
</style>
</head>
<body>
<canvas id="canvas" class="canvas" width="1920px" height="1080px"></canvas>
<script>
    const canvas = document.getElementById("canvas") /* 폭죽 터지는 모션 자바스크립트 따온 코드 */
    const ctx = canvas.getContext("2d")

    //Const
    const FLAT = canvas.height
    const FIREWORKS_COUNT = 20
    const EXP_COUNT = 20
    const AFTERIMG_COUNT = 10
    const RADIUS = 2

    //Class
    class Vector {
        constructor(x, y) {
            this.x = x
            this.y = y
        }
        add(b) {
            this.x += b.x
            this.y += b.y
        }
        clone() {
            return new Vector(this.x, this.y)
        }
    }

    class RGB {
        constructor(r, g, b, a = 1) {
            this.R = r
            this.G = g
            this.B = b
            this.A = a
        }
        toString() {
            return `rgb(${this.R}, ${this.G}, ${this.B}, ${this.A})`
        }
        alpha(value) {
            let A = value
            if (value < 0) {
                A = 0
            }
            return new RGB(this.R, this.G, this.B, A)
        }
    }

    class Fireworks {
        constructor(pos_x, pos_y, speedH, color = Palette[randint(Palette.length)]) {
            this.start = new Vector(pos_x, pos_y)
            this.color = color

            //Explosion Particle Count
            this.EXP_COUNT = EXP_COUNT

            // 0 : 상승, 1: 터짐
            this.mode = 0

            //Particle
            this.elevator = new Particle(pos_x, pos_y, 0, speedH, this.color)
            this.explosion = []
        }
        draw() {
            if (this.mode === 0) {
                this.elevate()
            } else {
                this.explode()
            }
        }
        elevate() {
            this.elevator.draw()
            this.elevator.move()
            this.elevator.vel.y += 0.008
            if (this.elevator.vel.y > 0) {
                const pos = this.elevator.pos
                for (var i = 0; i < this.EXP_COUNT; i++) {
                    this.explosion.push(new Particle(pos.x, pos.y,
                        rand(1.5) * randSym(), rand(1.5) * randSym(), this.color))
                }
                this.mode = 1
            }
        }
        explode() {
            this.explosion.forEach(i => {
                i.vel.y += 0.002
                i.life -= 0.004
                i.draw()
                i.move()
            })
        }
    }

    class Particle {
        constructor(x, y, vel_x, vel_y, color) {
            this.AFTERIMG_COUNT = AFTERIMG_COUNT

            this.life = 1
            this.pos = new Vector(x, y)
            this.vel = new Vector(vel_x, vel_y)
            this.color = color
            this.afterimg = []
        }
        draw() {
            Circle(this.pos, RADIUS, this.color)
            for (var i = 0; i < this.afterimg.length; i++) {
                let _color = this.color.alpha(i / this.AFTERIMG_COUNT - 1 + this.life)
                Circle(this.afterimg[i], RADIUS, _color)
            }
        }
        move() {
            this.color = this.color.alpha(this.life)

            this.afterimg.push(this.pos.clone())
            this.pos.add(this.vel)
            while (true) {
                if (this.afterimg.length <= this.AFTERIMG_COUNT) {
                    break
                }
                this.afterimg.shift()
            }
        }
    }

    //
    const Palette = [
        new RGB(232, 93, 4),
        new RGB(255, 205, 80),
        new RGB(199, 127, 232),
        new RGB(205, 0, 0)
    ]


    //Function
    function selectColor(color) {
        ctx.beginPath()
        ctx.fillStyle = color.toString()
        ctx.strokeStyle = color.toString()
    }

    function Circle(pos, r, color) {
        selectColor(color)
        ctx.arc(pos.x, pos.y, r, 0, Math.PI * 2, false)
        ctx.fill()
    }

    function randint(n) {
        // 0 ~ (n - 1)
        return Math.floor(Math.random() * n)
    }

    function rand(n) {
        return Math.random() * n
    }

    function randSym() {
        if (randint(2) == 0) {
            return 1
        }
        return -1
    }

    function getSym(n) {
        if (n < 0) {
            return -1
        }
        return +1
    }

    RenderList = [
    ]

    function makeFireworks() {
        return new Fireworks(randint(canvas.width),
            FLAT, -rand(2) - 2)
    }

    function createFireworks() {
        RenderList.push(makeFireworks())
    }

    createFireworks()

    let frame = 0
    function render() {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        if (RenderList.length < FIREWORKS_COUNT && frame % 40 == 0) {
            createFireworks()
        }
        for (var i = 0; i < RenderList.length; i++) {
            let count = RenderList[i].explosion.length
            if (RenderList[i].mode == 1) {
                if (RenderList[i].explosion[count - 1].life <= 0) {
                    RenderList[i] = makeFireworks()
                }
            }
        }
        RenderList.forEach(i => {
            i.draw()
        });

        frame++
        requestAnimationFrame(render)
    }

    render() /* 폭죽 스크립트 끝 */

</script>
<div id="a" style="overflow-y:hidden; height:8vh;>
<ul class="main_menu">&ensp;
<a href="../mboard/index.php?type=list&table=_notice&<?=$userid?>" class="menu_st">NOTICE</a>
<a href="../mboard/index.php?type=list2&table=_mem&<?=$userid?>" class="menu_st">DICE - GAME</a>
<a href="../mboard/index.php?type=list3&table=_mem&<?=$userid?>" class="menu_st">CHARGE - POINT</a>
</ul> <!-- main_menu -->
</div>
<ul class="buttons4">
<p1><li><button class="btn1">H<br>I<br>D<br>E</button></li></p1>
</ul>
<ul class="buttons5">
<p0><li><button class="btn2">M<br>E<br>N<br>U</button></li></p0>
</ul>
<?php
if(!$userid) {
    ?>
    <ul class="buttons15">
        <li><button type="button" onclick="location.href='../member/index.php?type=form'">S<br>I<br>G<br>N<br>I<br>N</button></li>
    </ul>
    <ul class="buttons14">
        <li><button type="button" onclick="location.href='../member/index.php?type=login_form'">L<br>O<br>G<br>I<br>N</button></li>
    </ul>
    <?php
} else {
    ?>
    <ul class="buttons15">
        <li><button type="button" onclick="location.href='../member/logout.php'">L<br>O<br>G<br>O<br>U<br>T</button></li>
    </ul>
    <ul class="buttons14">
        <li><button type="button" onclick="location.href='../member/index.php?type=modify_form'">E<br>D<br>I<br>T</button></li>
    </ul>
    <?php
}
?>
<header>
<div>
<p class="logo">
<a href="../main/index.php">BW-CASINO</a>
</p>
<img id='image' src='../img/logo.png'>
<ul class="top_menu">
<?php
echo "<li>WELLCOME&ensp;TO&ensp;DICE&ensp;CASINO!</li>";
if($userid) {
$userid = $_SESSION["userid"];
include "../include/db_connect.php";
$sql = "select * from _mem where id='$userid'";	//
$result = mysqli_query($con, $sql);			// SQL 명령 실행
$board=mysqli_fetch_array($result);
$logged = $username."(point:".$board['point']." Level:".$board['level'].")님 환영합니다. ";
echo "<l0>$logged</l0>";
}
?>
</ul> <!-- top_menu -->
</div>
</header>

</body>
</html>