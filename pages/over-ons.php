<?php require "includes/header.php" ?>

<!-- Over Ons Pagina -->
<div class="over-ons-container">
    <!-- Header Banner -->
    <div class="header-banner">
        <div class="overlay"></div>
        <img src="/assets/images/banner.jpeg" alt="Rydr banner" class="banner-img">
        <div class="banner-content">
            <h1>Over Rydr</h1>
        </div>
    </div>

    <!-- Content Container -->
    <div class="content-container">
        <!-- Over Ons Section -->
        <section class="about-section">
            <div class="section-header centered">
                <h2 class="section-title">Ons Verhaal</h2>
            </div>
            
            <div class="about-content">
                <div class="about-text">
                    <p>Ons hoofdkantoor bevindt zich in het bruisende hart van Rotterdam, direct naast het Centraal Station. Hier combineren we technologie, design en klantgerichtheid onder één dak.</p>
                    
                    <p>In een modern pand met uitzicht op de skyline werken we elke dag aan de mobiliteit van morgen. Loop je een keer binnen? De koffie staat klaar.</p>
                    
                    <p>Bij Rydr geloven we in flexibele mobiliteit voor iedereen. Of het nu gaat om een weekendje weg, een zakenreis, of het vervoeren van grote spullen met een bedrijfswagen - wij staan voor je klaar met de beste service en een uitgebreid wagenpark.</p>
                </div>
                
                <div class="about-image">
                    <img src="assets/images/work-place.png" alt="Rydr werkplek">
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <div class="section-header centered">
                <h2 class="section-title">Het Team</h2>
            </div>
            
            <p class="team-intro">Maak kennis met ons toegewijde team van professionals die elke dag werken aan de beste auto-huurervaring voor onze klanten. Met jarenlange ervaring in de mobiliteitssector én een passie voor service, staan zij voor je klaar.</p>
            
            <div class="team-cards">
                <!-- Team Member Card 1 -->
                <div class="team-card">
                    <div class="card-image">
                        <img src="assets/images/team/jasper-van-den-brink.png" alt="Jasper van den Brink">
                    </div>
                    <div class="card-content">
                        <h3>Jasper van den Brink</h3>
                        <h4>Oprichter & CEO</h4>
                        <p>Jasper richtte Rydr op in 2018 met een visie om autoverhuur toegankelijker te maken. Met zijn achtergrond in technologie en mobiliteit bouwt hij aan de toekomst van Rydr.</p>
                    </div>
                </div>
                
                <!-- Team Member Card 2 -->
                <div class="team-card">
                    <div class="card-image">
                        <img src="assets/images/team/lotte-de-graaf.png" alt="Lotte de Graaf">
                    </div>
                    <div class="card-content">
                        <h3>Lotte de Graaf</h3>
                        <h4>Operations Manager</h4>
                        <p>Lotte zorgt ervoor dat alles soepel verloopt, van reserveringen tot het onderhoud van onze voertuigen. Haar focus op kwaliteit maakt het verschil voor onze klanten.</p>
                    </div>
                </div>
                
                <!-- Team Member Card 3 -->
                <div class="team-card">
                    <div class="card-image">
                        <img src="assets/images/team/brian-mensah.png" alt="Brian Mensah">
                    </div>
                    <div class="card-content">
                        <h3>Brian Mensah</h3>
                        <h4>Marketing Specialist</h4>
                        <p>Brian vertelt het verhaal van Rydr aan de wereld. Met zijn creatieve aanpak zorgt hij ervoor dat we opvallen in de drukke markt van autoverhuur.</p>
                    </div>
                </div>
                
                <!-- Team Member Card 4 -->
                <div class="team-card">
                    <div class="card-image">
                        <img src="assets/images/team/youssef-amrani.png" alt="Youssef Amrani">
                    </div>
                    <div class="card-content">
                        <h3>Youssef Amrani</h3>
                        <h4>Technisch Directeur</h4>
                        <p>Youssef leidt onze technische ontwikkeling. Zijn innovatieve oplossingen maken het huren van een auto via Rydr een eenvoudige en plezierige ervaring.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Join Team Section -->
        <section class="join-section">
            <div class="join-content">
                <h2>Word onderdeel van ons team</h2>
                <p>Wij zijn altijd op zoek naar gedreven professionals die ons team komen versterken. Bekijk onze vacatures of neem contact met ons op om de mogelijkheden te bespreken.</p>
                <a href="/vacatures" class="button-primary">Bekijk vacatures</a>
            </div>
        </section>
    </div>
</div>

<style>
    /* Over Ons Page Styles */
    .over-ons-container {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
    }
    
    /* Header Banner */
    .header-banner {
        position: relative;
        height: 350px;
        overflow: hidden;
        margin-bottom: 60px;
    }
    
    .banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.5));
    }
    
    .banner-content {
        position: absolute;
        bottom: 50px;
        left: 50px;
        color: white;
    }
    
    .banner-content h1 {
        font-size: 3.5rem;
        margin: 0;
        font-weight: 700;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }
    
    /* Content Container */
    .content-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Section Styling */
    section {
        margin-bottom: 80px;
    }
    
    .section-header.centered {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .section-title {
        font-size: 2.2rem;
        color: #333;
        position: relative;
        display: inline-block;
        margin-bottom: 10px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #1e88e5;
        border-radius: 3px;
    }
    
    /* About Section */
    .about-content {
        display: flex;
        gap: 60px;
        align-items: center;
    }
    
    .about-text {
        flex: 1;
    }
    
    .about-text p {
        margin-bottom: 20px;
        line-height: 1.8;
        color: #444;
        font-size: 1.05rem;
    }
    
    .about-image {
        flex: 1;
    }
    
    .about-image img {
        width: 100%;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    /* Team Section */
    .team-intro {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 50px;
        line-height: 1.8;
        color: #444;
        font-size: 1.05rem;
    }
    
    .team-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .team-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        background-color: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .card-image {
        height: 280px;
        overflow: hidden;
    }
    
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .team-card:hover .card-image img {
        transform: scale(1.05);
    }
    
    .card-content {
        padding: 20px;
    }
    
    .card-content h3 {
        margin: 0 0 5px 0;
        color: #333;
        font-size: 1.3rem;
    }
    
    .card-content h4 {
        margin: 0 0 15px 0;
        color: #1e88e5;
        font-weight: 500;
        font-size: 0.95rem;
    }
    
    .card-content p {
        margin: 0;
        color: #666;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    
    /* Join Team Section */
    .join-section {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 60px 40px;
        text-align: center;
    }
    
    .join-content {
        max-width: 700px;
        margin: 0 auto;
    }
    
    .join-content h2 {
        margin-top: 0;
        margin-bottom: 20px;
        color: #333;
        font-size: 2rem;
    }
    
    .join-content p {
        margin-bottom: 30px;
        color: #555;
        line-height: 1.7;
    }
    
    .button-primary {
        display: inline-block;
        position: relative;
        z-index: 2;
        padding: 12px 30px;
        background-color: #1e88e5;
        color: white;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.3s;
    }
    
    .button-primary:hover {
        background-color: #1565c0;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .about-content {
            flex-direction: column;
            gap: 40px;
        }
        
        .about-image {
            order: -1;
            text-align: center;
        }
        
        .header-banner {
            height: 300px;
        }
        
        .banner-content h1 {
            font-size: 3rem;
        }
    }
    
    @media (max-width: 768px) {
        .team-cards {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }
        
        .header-banner {
            height: 250px;
        }
        
        .banner-content h1 {
            font-size: 2.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .team-cards {
            grid-template-columns: 1fr;
            max-width: 350px;
            margin: 0 auto;
        }
        
        .header-banner {
            height: 200px;
        }
        
        .banner-content {
            bottom: 30px;
            left: 30px;
        }
        
        .banner-content h1 {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<?php require "includes/footer.php" ?>
