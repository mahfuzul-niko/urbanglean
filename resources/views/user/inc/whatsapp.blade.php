<style>
    /* WhatsApp Start (20% Smaller) */
    button.wh-ap-btn {
        outline: none;
        width: 40px; /* was 50px */
        height: 40px; /* was 50px */
        border: 0;
        background-color: #2ecc71;
        padding: 0;
        border-radius: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        cursor: pointer;
        transition: opacity 0.3s, background 0.3s, box-shadow 0.3s;
        position: relative;
    }

    button.wh-ap-btn::after {
        content: "";
        background-image: url("{{ asset('frontend/assets/img/icon/WhatsApp.png') }}");
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 60%;
        width: 100%;
        height: 100%;
        display: block;
        opacity: 1;
    }

    button.wh-ap-btn:hover {
        opacity: 1;
        background-color: #20bf6b;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .wh-api {
        position: fixed;
        bottom: 0;
        right: 0;
    }

    .wh-fixed {
        margin-right: 8px; /* was 10px */
        margin-bottom: 55px; /* was 55px */
    }

    .wh-fixed > a {
        display: block;
        text-decoration: none;
    }

    button.wh-ap-btn::before {
        content: "Chat with me";
        display: block;
        position: absolute;
        margin-left: -100px; /* was -120px */
        margin-top: 10px; /* was 12px */
        height: 18px; /* was 22px */
        background: #49654e;
        color: #fff;
        font-weight: 400;
        font-size: 11px; /* was 13px */
        border-radius: 3px;
        width: 0;
        opacity: 0;
        padding: 0;
        transition: opacity 0.4s, width 0.4s, padding 0.5s;
        padding-top: 4px;
        border-radius: 30px;
        box-shadow: 0 1px 10px rgba(32, 33, 36, 0.28);
    }

    /* animacion pulse */
    .whatsapp-pulse {
        width: 40px; /* was 50px */
        height: 40px; /* was 50px */
        right: 12px; /* was 14px */
        bottom: 8px; /* was 10px */
        background: #10b418;
        position: fixed;
        text-align: center;
        color: #ffffff;
        cursor: pointer;
        border-radius: 50%;
        z-index: 99;
        display: inline-block;
        line-height: 45px; /* was 55px */
    }

    .whatsapp-pulse:before {
        position: absolute;
        content: " ";
        z-index: -1;
        bottom: -10px; /* was -12px */
        right: -10px; /* was -12px */
        background-color: #10b418;
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
    /* WhatsApp End */
</style>

{{-- WhatsApp Start --}}
<div class="wh-api" style="z-index:1;">
	<div class="wh-fixed whatsapp-pulse">
		<a href="https://api.whatsapp.com/send?phone={{ optional($business)->whatsapp }}&text=">
			<button class="wh-ap-btn"></button>
		</a>
	</div>
</div>
{{-- WhatsApp End --}}
