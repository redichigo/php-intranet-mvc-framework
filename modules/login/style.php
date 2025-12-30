<style>
    /* ---------------------------------------------------------------- */
    /* SIDE NAV */
    /* ---------------------------------------------------------------- */
    .sidenav {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow-x: hidden;
        padding: 10px;
        height: 100vh;
        background-color: #455065;
    }

    .sidenav_text {
        padding: 60px;
        color: #ffffff;
    }

    .sidenav_text h2 {
        color: #cfd8dc;
    }

    /* ---------------------------------------------------------------- */
    /* MAIN */
    /* ---------------------------------------------------------------- */
    .main {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        height: 100vh;
    }

    #info_login {
        text-align: center;
        color: #dc3545;
    }

    /* ---------------------------------------------------------------- */
    /* MEDIA QUERY */
    /* ---------------------------------------------------------------- */
    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }
    }

    @media screen and (max-width: 450px) {
        .login_form {
            margin-top: 10%;
        }
    }

    @media screen and (min-width: 768px) {
        .main {
            margin-left: 40%;
        }

        .sidenav {
            width: 40%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
        }
    }
</style>