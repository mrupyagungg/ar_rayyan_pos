<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Meta Responsive tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login | Ar Rayyan POS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('style/assets/img/logo_sambeljerit.png') }}" />
</head>

<style>
    @import url("https://fonts.googleapis.com/css?family=Nunito:400,600,700");

    @import url('https://fonts.googleapis.com/css2?family=Eagle+Lake&family=Rye&family=Sonsie+One&display=swap');

    * {
        box-sizing: border-box;
    }

    body {
        font-family: "Nunito", sans-serif;
        color: rgba(#000, 0.7);
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        /* Prevent horizontal scroll */
    }

    .container {
        background: linear-gradient(rgba(0, 0, 0, 0.600), rgba(0, 0, 0, 0.8)),
            url(https://images.unsplash.com/photo-1580828343064-fde4fc206bc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        padding: 20px;
    }


    .modal {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 60px;
        background: rgba(#333, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: 0.4s;
    }

    .modal-container {
        display: flex;
        max-width: 720px;
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
        position: absolute;
        opacity: 0;
        pointer-events: none;
        transition-duration: 0.3s;
        background: #fff;
        transform: translateY(100px) scale(0.4);
        font-style: normal;
    }

    .modal-title {
        font-size: 26px;
        margin: 0;
        font-weight: 400;
        color: #55311c;
        font-style: normal;
    }

    .modal-titles {
        font-size: 26px;
        margin: 0;
        font-weight: 400;
        color: #55311c;
        /* font-style: normal; */
    }

    .modal-descs {
        margin: 6px 0 30px 0;
        font-style: italic;
    }

    .modal-desc {
        margin: 6px 0 30px 0;
    }

    .modal-left {
        padding: 60px 30px 20px;
        background: #fff;
        flex: 1.5;
        transition-duration: 0.5s;
        transform: translateY(80px);
        opacity: 0;
    }

    .modal-button {
        color: #fff;
        /* Warna teks default */
        font-family: "Nunito", sans-serif;
        font-size: 18px;
        cursor: pointer;
        border: 0;
        outline: 0;
        padding: 10px 40px;
        border-radius: 30px;
        background: rgba(149, 3, 3, 0.622);
        /* Warna latar default */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
        transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-button:hover {
        background: rgb(200, 50, 50);
        /* Warna latar lebih terang */
        transform: scale(1.05);
        /* Sedikit memperbesar tombol */
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
        /* Tambahkan bayangan */
        color: #fff;
        /* Pastikan warna teks tetap putih */
    }


    .modal-right {
        flex: 2;
        font-size: 0;
        transition: 0.3s;
        overflow: hidden;
    }

    .modal-right img {
        width: 100%;
        height: 100%;
        transform: scale(2);
        object-fit: cover;
        transition-duration: 1.2s;
    }

    .modal.is-open {
        height: 100%;
        background: rgba(#333, 0.85);
    }

    .modal.is-open .modal-button {
        opacity: 0;
    }

    .modal.is-open .modal-container {
        opacity: 1;
        transition-duration: 0.6s;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }

    .modal.is-open .modal-right img {
        transform: scale(1);
    }

    .modal.is-open .modal-left {
        transform: translateY(0);
        opacity: 1;
        transition-delay: 0.1s;
    }

    .modal-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-buttons a {
        color: rgba(51, 51, 51, 0.6);
        /* Warna teks default */
        font-size: 14px;
        text-decoration: none;
        /* Hilangkan garis bawah */
        transition: color 0.3s ease, text-decoration 0.3s ease;
        /* Animasi transisi */
    }

    .modal-buttons a:hover {
        color: rgba(247, 28, 28, 0.9);
    }


    .sign-up {
        margin: 60px 0 0;
        font-size: 14px;
        text-align: center;
    }

    .sign-up a {
        color: #1c0088;
    }

    .input-button {
        padding: 8px 12px;
        outline: none;
        border: 0;
        color: #fff;
        border-radius: 4px;
        background: #1c0088;
        font-family: "Nunito", sans-serif;
        transition: 0.3s;
        cursor: pointer;
    }

    .input-button:hover {
        background: #55311c;
    }

    .input-label {
        font-size: 11px;
        text-transform: uppercase;
        font-family: "Nunito", sans-serif;
        font-weight: 600;
        letter-spacing: 0.7px;
        color: #1c0088;
        transition: 0.3s;
    }

    .input-block {
        display: flex;
        flex-direction: column;
        padding: 10px 10px 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .input-block input {
        outline: 0;
        border: 0;
        padding: 4px 0 0;
        font-size: 14px;
        font-family: "Nunito", sans-serif;
    }

    .input-block input::placeholder {
        color: #ccc;
        opacity: 1;
    }

    .input-block:focus-within {
        border-color: #1c0088;
    }

    .input-block:focus-within .input-label {
        color: rgba(#1c0088, 0.8);
    }

    .icon-button {
        outline: 0;
        position: absolute;
        right: 10px;
        top: 12px;
        width: 32px;
        height: 32px;
        border: 0;
        background: 0;
        padding: 0;
        cursor: pointer;
    }

    .scroll-down {
        position: fixed;
        top: 50%;
        font-family: "Sonsie One", serif;
        left: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        font-size: 50px;
        color: #ffffff;
        font-weight: 800;
        transform: translate(-50%, -50%);
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        /* Bayangan teks */

    }

    .modal-descss {
        font-size: 28px;
        /* Ukuran font */
        font-family: Arial, sans-serif;
        color: #e0e0e0;
        /* Warna teks */
        white-space: nowrap;
        /* Mencegah teks membungkus */
        overflow: hidden;
        /* Menyembunyikan teks yang belum muncul */
        border-right: 2px solid #333;
        /* Efek kursor */
        animation: blink-cursor 0.8s steps(1) infinite;
    }

    @keyframes blink-cursor {
        50% {
            border-color: transparent;
            /* Kedip kursor */
        }
    }



    @media(max-width: 750px) {
        .modal-container {
            width: 90%;
        }

        .modal-right {
            display: none;
        }
    }
</style>

<body class="login-body">

    <!-- Login Wrapper -->
    <div class="container-fluid login-wrapper">
        <div class="scroll-down">AR-RAYYAN POS
            <h3>
                <img src="{{ asset('style/assets/img/logo_sambeljerit.png') }}" alt="Logo Sambel Jerit"
                    class="rounded-circle" width="150px" height="150px">
            </h3>
            <div class="modal-descss" id="typing-effect"></div>

        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const text = "System Point Of Sales";
                const target = document.getElementById("typing-effect");
                let index = 0;

                const typingEffect = () => {
                    if (index < text.length) {
                        target.textContent += text.charAt(index); // Tambahkan satu karakter
                        index++;
                        setTimeout(typingEffect, 100); // Sesuaikan kecepatan mengetik (100ms)
                    } else {
                        setTimeout(() => {
                            target.textContent = "";
                            index = 0;
                            typingEffect();
                        }, 999);
                    }
                };

                typingEffect();
            });
        </script>


        <div class="container"></div>
        <div class="modal">
            <div class="modal-container">
                <div class=""></div>
                <div class="modal-left">
                    <h1 class="modal-title"><span>Welcome!</span></h1>
                    <h class="modal-title"><span>Ar-Rayan POS</span></h>
                    <p class="modal-descs">"Menghasilkan uang itu penting, tetapi menjaga uang agar tetap tumbuh adalah
                        kunci keberhasilan sejati."<br>
                        <span style=""> – Benjamin Graham</span>
                    </p>

                    <form method="POST" action="{{ route('login') }}" class="mt-2">
                        @csrf
                        <div class="input-block mb-4">
                            <label for="email" class="input-label">Email</label>
                            <input id="email" class="form-control mt-1" type="email" name="email"
                                placeholder="Exampel@email.com" required autofocus />
                        </div>
                        <div class="input-block mb-4">
                            <label for="password" class="input-label">Password</label>
                            <input id="password" class="form-control  mb-4" type="password" name="password"
                                placeholder="Min 8 Character" required />
                        </div>
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="modal-buttons">
                                <a href="{{ route('password.request') }}" class="">Forgot your password?</a>
                                <button class="input-button">Login</button>
                            </div>
                        </div>
                    </form>
                    <p class="sign-up">Don't have an account? <a href="#">Sign up now</a></p>
                </div>
                <div class="modal-right">
                    <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?fm=jpg&q=60&w=3000"
                        alt="">
                </div>
                <button class="icon-button close-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <path
                            d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z">
                        </path>
                    </svg>
                </button>
            </div>
            <button class="modal-button">Click here to login</button>
        </div>
    </div>

    <script>
        const body = document.querySelector("body");
        const modal = document.querySelector(".modal");
        const modalButton = document.querySelector(".modal-button");
        const closeButton = document.querySelector(".close-button");
        const scrollDown = document.querySelector(".scroll-down");
        let isOpened = false;

        const openModal = () => {
            modal.classList.add("is-open");
            body.style.overflow = "hidden";
        };

        const closeModal = () => {
            modal.classList.remove("is-open");
            body.style.overflow = "initial";
        };

        window.addEventListener("scroll", () => {
            if (window.scrollY > window.innerHeight / 3 && !isOpened) {
                isOpened = true;
                scrollDown.style.display = "none"; // Sembunyikan indikator scroll
                openModal(); // Buka modal
            }
        });

        modalButton.addEventListener("click", openModal);
        closeButton.addEventListener("click", closeModal);

        document.onkeydown = (evt) => {
            evt = evt || window.event;
            if (evt.keyCode === 27) {
                closeModal();
            }
        };
    </script>

</body>


</html>
