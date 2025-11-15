<style>
    /* Messenger Floating Button (20% Smaller) */
    #messenger__top {
        position: fixed;
        bottom: 115px; /* was 130px */
        right: 20px; /* was 25px */
        z-index: 99;
        outline: 0;
        background-color: #1773EA;
        -webkit-box-shadow: 0 2px 18px rgba(0, 0, 0, .16);
        box-shadow: 0 2px 18px rgba(0, 0, 0, .16);
        cursor: pointer;
        -webkit-transform: translateY(40px);
        transform: translateY(40px);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: .3s;
        transition: .3s;
        line-height: 1;
        width: 40px; /* was 50px */
        height: 40px; /* was 50px */
        border-radius: 50%;
        border: 0;
    }

    #messenger__top:hover {
        background: #1773EA;
    }

    #messenger__top.active {
        visibility: visible;
        opacity: 1;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    #messenger__top svg {
        width: 36px; /* was 45px */
        margin-top: 8px; /* was 10px */
        line-height: 1;
    }

    a.messenger {
        color: var(--white-color);
    }

    a.messenger:hover {
        background-color: #1773EA;
    }

    .messenger-pulse {
        width: 40px; /* was 50px */
        height: 40px; /* was 50px */
        right: 8px; /* was 10px */
        bottom: 72px; /* was 90px */
        background: #1773EA;
        position: fixed;
        text-align: center;
        color: #ffffff;
        cursor: pointer;
        border-radius: 50%;
        z-index: 99;
        display: inline-block;
        line-height: 45px; /* was 55px */
    }

    .messenger-pulse:before {
        position: absolute;
        content: " ";
        z-index: -1;
        bottom: -10px; /* was -12px */
        right: -10px; /* was -12px */
        background-color: #1773EA;
        width: 60px; /* was 75px */
        height: 60px; /* was 75px */
        border-radius: 100%;
        animation-fill-mode: both;
        -webkit-animation-fill-mode: both;
        opacity: 0.6;
        -webkit-animation: pulse 1s ease-out;
        animation: pulse 1.8s ease-out;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
    }

    @-webkit-keyframes pulse {
        0% { -webkit-transform: scale(0); opacity: 0; }
        25% { -webkit-transform: scale(0.3); opacity: 1; }
        50% { -webkit-transform: scale(0.6); opacity: 0.6; }
        75% { -webkit-transform: scale(0.9); opacity: 0.3; }
        100% { -webkit-transform: scale(1); opacity: 0; }
    }

    @keyframes pulse {
        0% { transform: scale(0); opacity: 0; }
        25% { transform: scale(0.3); opacity: 1; }
        50% { transform: scale(0.6); opacity: 0.6; }
        75% { transform: scale(0.9); opacity: 0.3; }
        100% { transform: scale(1); opacity: 0; }
    }
</style>

<a id="messenger__top" class="active messenger messenger-pulse" href="{{ optional($business)->messenger }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-messenger"
        viewBox="0 0 16 16">
        <path
            d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.64.64 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.64.64 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76m5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z" />
    </svg>
</a>
