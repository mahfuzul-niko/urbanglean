<style>
    /* Facebook Floating Button (20% Smaller) */
    #facebook__top {
        position: fixed;
        bottom: 168px; /* was 193px */
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

    #facebook__top:hover {
        background: #1773EA;
    }

    #facebook__top.active {
        visibility: visible;
        opacity: 1;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    #facebook__top svg {
        width: 32px; /* was 40px */
        margin-top: 7px; /* was 9px */
        line-height: 1;
    }

    a.facebook {
        color: var(--white-color);
    }

    a.facebook:hover {
        background-color: #1773EA;
    }

    .facebook-pulse {
        width: 40px; /* was 50px */
        height: 40px; /* was 50px */
        right: 8px; /* was 10px */
        bottom: 144px; /* was 180px */
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

    .facebook-pulse:before {
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

<a id="facebook__top" class="active facebook facebook-pulse" href="{{ optional($business)->facebook }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="feather feather-facebook">
        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
    </svg>
</a>
