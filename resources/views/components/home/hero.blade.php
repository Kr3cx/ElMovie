<!-- Hero Section -->
<div class="container-fluid px-0" style="margin-top: 30px;">
    <div class="white-blue-background">
        <div id="particles-js"></div>
        <div class="spotlight-blue"></div>
<div class="film-reel top-left"></div>
<div class="film-reel top-center"></div>
<div class="film-reel center-left"></div>
<div class="film-reel center-right"></div>
<div class="film-reel bottom-center"></div>
<div class="film-reel bottom-right"></div>
<div class="clapper main"></div>
<div class="clapper top-right"></div>
<div class="clapper center"></div>
<div class="clapper bottom-left"></div>
<div class="clapper center-right"></div>
        <div class="container hero-content">
            <div class="row min-vh-50 align-items-center justify-content-center text-center">
                <div class="col-lg-8 py-5">
                    <h1 class="display-3 fw-bold text-blue mb-4 float-animation">Welcome to <span class="text-accent">ElMovie</span></h1>
                    <p class="lead text-blue mb-4 fs-4 float-animation">Discover, discuss, and review your favorite movies</p>
                    <div class="d-flex justify-content-center gap-4 mt-5">
                        <a href="/films" class="btn hero-btn-blue btn-primary btn-lg">Explore Movies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for White-Blue Theme -->
<style>
    :root {
        --blue-primary: #4285F4;
        --blue-dark: #1A73E8;
        --blue-light: #D2E3FC;
        --blue-bg: #E8F0FE;
        --blue-accent: #34A853;
        --white: #FFFFFF;
        --shadow: rgba(60, 64, 67, 0.15);
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--white);
        color: var(--blue-dark);
    }
    
    .white-blue-background {
        position: relative;
        background: linear-gradient(135deg, var(--white), var(--blue-bg));
        overflow: hidden;
    }
    
    .white-blue-background::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/api/placeholder/1920/1080');
        background-size: cover;
        background-position: center;
        opacity: 0.07;
        filter: saturate(0.8) brightness(1.1);
    }
    
    #particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 1;
    background-color: rgba(66, 133, 244, 0.05); /* Add slight blue tint */
}

/* Add this to make particles more visible */
#particles-js canvas {
    opacity: 1 !important;
    filter: contrast(150%) brightness(120%);
}
    
    .hero-content {
        position: relative;
        z-index: 2;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    h1 {
        letter-spacing: 1px;
        font-weight: 800;
    }
    
    .text-blue {
        color: var(--blue-dark);
    }
    
    .text-accent {
        color: var(--blue-primary);
        text-shadow: 0 0 15px rgba(66, 133, 244, 0.3);
    }
    
    .hero-btn-blue {
        background: linear-gradient(45deg, var(--blue-primary), var(--blue-dark));
        border: none;
        color: var(--white);
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 4px 15px rgba(66, 133, 244, 0.3);
    }
    
    .hero-btn-blue::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, var(--blue-dark), var(--blue-primary));
        transition: all 0.4s ease;
        z-index: -1;
    }
    
    .hero-btn-blue:hover::before {
        left: 0;
    }
    
    .hero-btn-blue:hover {
        box-shadow: 0 0 20px rgba(66, 133, 244, 0.5);
        transform: translateY(-3px);
        color: var(--white);
    }
    
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
        100% {
            transform: translateY(0px);
        }
    }
    
    .spotlight-blue {
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 50% 50%, rgba(66, 133, 244, 0.1), transparent 70%);
        pointer-events: none;
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
 /* Film Reel Base Styles */
.film-reel {
    position: absolute;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%234285F4'%3E%3Cpath d='M50 0c-27.6 0-50 22.4-50 50s22.4 50 50 50 50-22.4 50-50-22.4-50-50-50zm0 15c2.8 0 5 2.2 5 5s-2.2 5-5 5-5-2.2-5-5 2.2-5 5-5zm-19.3 7.9c2.4 1.4 3.2 4.4 1.8 6.8s-4.4 3.2-6.8 1.8c-2.4-1.4-3.2-4.4-1.8-6.8 1.4-2.4 4.4-3.2 6.8-1.8zm38.6 0c2.4-1.4 5.4-.6 6.8 1.8 1.4 2.4.6 5.4-1.8 6.8-2.4 1.4-5.4.6-6.8-1.8-1.4-2.4-.6-5.4 1.8-6.8zm-19.3 7.1c14 0 25 11 25 25s-11 25-25 25-25-11-25-25 11-25 25-25zm-33.6 18.5c0-2.8 2.2-5 5-5s5 2.2 5 5-2.2 5-5 5-5-2.2-5-5zm57.2 0c0-2.8 2.2-5 5-5s5 2.2 5 5-2.2 5-5 5-5-2.2-5-5zm-44.9 26.4c-2.4-1.4-3.2-4.4-1.8-6.8 1.4-2.4 4.4-3.2 6.8-1.8 2.4 1.4 3.2 4.4 1.8 6.8-1.4 2.4-4.4 3.2-6.8 1.8zm32.6 0c-2.4 1.4-5.4.6-6.8-1.8-1.4-2.4-.6-5.4 1.8-6.8 2.4-1.4 5.4-.6 6.8 1.8 1.4 2.4.6 5.4-1.8 6.8zm-16.3 7.1c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5z'/%3E%3C/svg%3E");
    background-size: contain;
    opacity: 0.4;
    z-index: 0;
}

/* Film Reel Positions and Animations */
.film-reel.top-left {
    top: 5%;
    left: 5%;
    width: 120px;
    height: 120px;
    animation: spin 20s linear infinite;
}

.film-reel.top-right {
    top: 10%;
    right: 10%;
    width: 90px;
    height: 90px;
    animation: spin 18s linear infinite;
}

.film-reel.top-center {
    top: 8%;
    left: 45%;
    width: 70px;
    height: 70px;
    animation: spin 17s linear infinite;
}

.film-reel.center-left {
    top: 40%;
    left: 8%;
    width: 110px;
    height: 110px;
    animation: spin 25s linear infinite;
}

.film-reel.center-right {
    top: 35%;
    right: 8%;
    width: 100px;
    height: 100px;
    animation: spin 23s linear infinite reverse;
}

.film-reel.bottom-left {
    bottom: 15%;
    left: 15%;
    width: 80px;
    height: 80px;
    animation: spin 22s linear infinite reverse;
}

.film-reel.bottom-right {
    bottom: 5%;
    right: 5%;
    width: 120px;
    height: 120px;
    animation: spin 15s linear infinite reverse;
}

.film-reel.bottom-center {
    bottom: 8%;
    right: 45%;
    width: 75px;
    height: 75px;
    animation: spin 19s linear infinite reverse;
}

/* Spin Animation */
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Clapper Base Styles */
.clapper {
    position: absolute;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' fill='%234285F4'%3E%3Cpath d='M448 64h-32v-8c0-13.2-10.8-24-24-24H120c-13.2 0-24 10.8-24 24v8H64c-35.3 0-64 28.7-64 64v256c0 35.3 28.7 64 64 64h384c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64zM120 56h272v48H120V56zm328 328c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V128c0-8.8 7.2-16 16-16h52.2l-51.2 48H48c-8.8 0-16 7.2-16 16s7.2 16 16 16h416c8.8 0 16-7.2 16-16s-7.2-16-16-16h-32.9l-51.2-48H432c8.8 0 16 7.2 16 16v256z'/%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
    opacity: 0.4;
}

/* Clapper Positions */
.clapper.main {
    bottom: 10%;
    left: 10%;
    width: 90px;
    height: 90px;
    transform: rotate(-15deg);
}

.clapper.top-right {
    top: 15%;
    right: 10%;
    width: 80px;
    height: 80px;
    transform: rotate(15deg);
}

.clapper.center {
    top: 40%;
    left: 45%;
    width: 70px;
    height: 70px;
    transform: rotate(0deg);
}

.clapper.bottom-left {
    bottom: 25%;
    left: 20%;
    width: 65px;
    height: 65px;
    transform: rotate(-25deg);
}

.clapper.center-right {
    top: 60%;
    right: 15%;
    width: 75px;
    height: 75px;
    transform: rotate(10deg);
}
</style>
