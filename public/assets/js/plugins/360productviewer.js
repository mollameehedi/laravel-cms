"use strict";
(function () {

    var call = 0;

    function pdt360DegViewer (product) {
        call++;
        loaderNone(product.id);
        var i = 1, j = 0, move = [],
        mainDiv = document.querySelector(`#${product.id}`);
        mainDiv.className = 'viewer';
        mainDiv.innerHTML += `<img class="${product.id} ${product.playable ? 'playable ' : ''}${product.autoPlay ? 'autoPlay ' : ''}${product.draggable ? 'draggable ' : ''}${product.mousemove ? 'mouseMove ' : ''}${product.buttonnavigation ? 'buttons ' : ''}${product.scroll ? 'scroll ' : ''}" draggable="false" src='${product.path}${i}.${product.imgtype}'>`;
        mainDiv.innerHTML +=
            '<div class="loader"><div class="three-bounce"><div class="one"></div><div class="two"></div><div class="three"></div></div></div>'
        var img = document.querySelector(`#${product.id} .${product.id}`);

        if (!product.playable && !product.autoPlay) {
            var touch = false;
            (window.matchMedia("screen and (max-width: 500px)").matches) ? touchFun() : nonTouch();

            //For Touch Devices
            window.addEventListener('touchstart', function () {
                touchFun();
            });

            function touchFun() {
                touch = true;
                img.removeAttribute('draggable');
                img.addEventListener('touchmove', function (e) {
                    logic(this, e);
                });
                img.addEventListener('touchend', function (e) {
                    move = [];
                });
            }
            //For Non-Touch Devices
            function nonTouch() {
                touch = false;
                if (product.draggable) {
                    var drag = false;
                    img.addEventListener('mousedown', function (e) {
                        drag = true;
                        logic(this, e);
                    });
                    img.addEventListener('mouseup', function (e) {
                        drag = false;
                        move = [];
                    });
                    mouseEvent();
                }

                if (product.mousemove) {
                    drag = true;
                    mouseEvent();
                }
                function mouseEvent() {
                    img.addEventListener('mousemove', function (e) {
                        (drag) ? logic(this, e) : null;
                    });
                    img.addEventListener('mouseleave', function () {
                        move = [];
                    });
                }
                if (product.scroll) {
                    img.addEventListener('wheel', function (e) {
                        e.preventDefault();
                        (e.wheelDelta / 120 > 0) ? nxt(this) : prev(this);
                    });
                }
            }
            function logic(el, e) {
                j++;
                var x = touch ? e.touches[0].clientX : e.clientX;
                var coord = (x - img.offsetLeft);
                move.push(coord);

                var l = move.length,
                    oldMove = move[l - 2],
                    newMove = move[l - 1];
                var thresh = touch ? true : !(j % 3);
                if (thresh) {
                    if (newMove > oldMove)
                        nxt(el);
                    else if (newMove < oldMove)
                        prev(el);
                }
            }
            if (product.buttonnavigation) {
                var btnsDiv = document.createElement('div');
                btnsDiv.className = 'btnDiv navDiv';

                var leftNavBtn = document.createElement('button');
                leftNavBtn.className = 'play leftNav';
                leftNavBtn.setAttribute('title', 'left navigation');
                btnsDiv.appendChild(leftNavBtn);
                leftNavBtn.addEventListener('click', function () {
                    prev(img);
                });

                var rightNavBtn = document.createElement('button');
                rightNavBtn.className = 'play rightNav';
                rightNavBtn.setAttribute('title', 'right navigation');
                btnsDiv.appendChild(rightNavBtn);
                rightNavBtn.addEventListener('click', function () {
                    nxt(img);
                });
                img.parentNode.appendChild(btnsDiv);
            }
        } else {
            var interval, playing = false,
                pause = false,
                left = false,
                right = false,
                speed = 150;

            if ( product.playable) {
                var btnDiv = document.createElement('div');
                btnDiv.className = 'btnDiv';

                var playBtn = document.createElement('button');
                playBtn.className = 'play ';
                playBtn.setAttribute('title', 'play');
                btnDiv.appendChild(playBtn);
                playBtn.addEventListener('click', function () {
                    playing = true;
                    pause = false;
                    play();
                });

                var pauseBtn = document.createElement('button');
                pauseBtn.className = 'pause ';
                pauseBtn.setAttribute('title', 'pause');
                btnDiv.appendChild(pauseBtn);
                pauseBtn.addEventListener('click', function () {
                    pause = true;
                });

                var stopBtn = document.createElement('button');
                stopBtn.className = 'stop ';
                stopBtn.setAttribute('title', 'stop');
                btnDiv.appendChild(stopBtn);

                stopBtn.addEventListener('click', function () {
                    pause = true;
                    speed = 50;
                    right = true;
                    left = false;
                    this.parentNode.parentNode.querySelector('img').src = `${product.path}${i = 1}.${product.imgtype}`;
                });

                var leftBtn = document.createElement('button');
                leftBtn.className = 'left ';
                leftBtn.setAttribute('title', 'play direction-left');
                btnDiv.appendChild(leftBtn);
                leftBtn.addEventListener('click', function () {
                    right = false;
                    left = true;
                    if (playing)
                        play();
                });

                var rightBtn = document.createElement('button');
                rightBtn.className = 'right ';
                rightBtn.setAttribute('title', 'play direction-right');
                btnDiv.appendChild(rightBtn);
                rightBtn.addEventListener('click', function () {
                    left = false;
                    right = true;
                    if (playing)
                        play();
                });

                var speedBtn = document.createElement('button');
                speedBtn.className = 'fast ';
                speedBtn.setAttribute('title', 'increase play speed');
                btnDiv.appendChild(speedBtn);
                speedBtn.addEventListener('click', function () {
                    if (playing)
                        timer(speed > 50 ? speed -= 20 : speed);
                });

                var slowBtn = document.createElement('button');
                slowBtn.className = 'slow ';
                slowBtn.setAttribute('title', 'decrease play speed');
                btnDiv.appendChild(slowBtn);
                slowBtn.addEventListener('click', function () {
                    if (playing)
                        timer(speed < 100 ? speed += 10 : speed);
                });

                mainDiv.prepend(btnDiv);
            }
        }

        function play() {
            timer(speed);
        }

        function timer(t) {
            clearInterval(interval);
            interval = setInterval(function () {
                if (!pause) {
                    if (left)
                        prev(img);
                    else if (right)
                        nxt(img);
                    else
                        nxt(img);
                }
            }, t);
        }

        function prev(e) {
            if (i <= 1) {
                i = product.count;
                e.src = `${product.path}${--i}.${product.imgtype}`;
                nxt(e);
            } else
                e.src = `${product.path}${--i}.${product.imgtype}`;
        }
        function nxt(e) {
            if (i >= product.count) {
                i = 1;
                e.src = `${product.path}${++i}.${product.imgtype}`;
                prev(e);
            } else
                e.src = `${product.path}${++i}.${product.imgtype}`;
        }
        function loaderNone(id) {
            window.addEventListener('load',function(){
                document.querySelector(`#${id} .loader`).style.display = 'none';
                if (product.autoPlay) {
                    pause = false;
                    play();
                }
            });
        }
    }
    const elem = document.querySelector('[data-id="product-viewer"]');
    if(elem !== null) {
        const productdetails = {
            id: elem.getAttribute("id"),
            count: elem.getAttribute("data-count"),
            path: elem.getAttribute("data-path"),
            imgtype: elem.getAttribute("data-imgtype"),
            playable: elem.getAttribute("data-playable") == "true",
            autoPlay: elem.getAttribute("data-autoPlay") == "true",
            draggable: elem.getAttribute("data-drag")== "true",
            mousemove: elem.getAttribute("data-mousemove")== "true",
            buttonnavigation: elem.getAttribute("data-buttonnavigation")== "true",
            scroll: elem.getAttribute("data-scroll")== "true"
        };

        pdt360DegViewer(productdetails);
    }
})();