<?php require __DIR__ . "/../includes/header.php" ?>

<!-- Onze Visie Pagina -->
<div class="page-container">
    <!-- Header Banner -->
    <div class="header-banner">
        <div class="overlay"></div>
        <img src="/assets/images/banner.jpeg" alt="Rydr banner" class="banner-img">
        <div class="banner-content">
            <h1>Onze Visie</h1>
        </div>
    </div>

    <!-- Content Container -->
    <div class="content-container">
        <section class="intro-section">
            <div class="section-header centered">
                <h2 class="section-title">De toekomst van mobiliteit</h2>
            </div>
            <p class="intro-text">
                Bij Rydr geloven we dat mobiliteit draait om vrijheid, flexibiliteit en duurzaamheid. 
                Onze visie is een wereld waarin iedereen toegang heeft tot betrouwbaar vervoer, 
                precies wanneer het nodig is, zonder de lasten van autobezit.
            </p>
        </section>

        <!-- Visie Punten -->
        <section class="vision-section">
            <div class="vision-grid">
                <div class="vision-item">
                    <div class="vision-icon">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h3>Duurzaamheid</h3>
                    <p>
                        We streven ernaar om onze ecologische voetafdruk te verkleinen door het aanbieden van 
                        elektrische en hybride voertuigen en het optimaliseren van ons wagenpark om CO2-uitstoot te verminderen.
                    </p>
                </div>
                
                <div class="vision-item">
                    <div class="vision-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h3>Toegankelijkheid</h3>
                    <p>
                        We maken autohuur toegankelijk voor iedereen met transparante prijzen, 
                        eenvoudige processen en een breed scala aan voertuigen voor elke behoefte.
                    </p>
                </div>
                
                <div class="vision-item">
                    <div class="vision-icon">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <h3>Innovatie</h3>
                    <p>
                        We blijven voortdurend innoveren met nieuwe technologieën en diensten 
                        om de ervaring van onze klanten te verbeteren en voorop te blijven lopen in de mobiliteitsmarkt.
                    </p>
                </div>
                
                <div class="vision-item">
                    <div class="vision-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>
                        We bouwen aan een gemeenschap van mensen die onze waarden delen en 
                        betrekken hen bij het vormgeven van de toekomst van mobiliteit.
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Quote Section -->
        <section class="quote-section">
            <blockquote>
                "Onze missie is om mobiliteit te democratiseren en mensen de vrijheid te geven om te gaan waar ze willen, wanneer ze willen."
                <cite>— Oprichter, Rydr</cite>
            </blockquote>
        </section>
        
        <!-- Timeline -->
        <section class="timeline-section">
            <div class="section-header">
                <h2 class="section-title">Onze Reis</h2>
            </div>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">2018</div>
                    <div class="timeline-content">
                        <h3>Het Begin</h3>
                        <p>Rydr werd opgericht met slechts 5 auto's en een droom om autohuur te revolutioneren.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">2020</div>
                    <div class="timeline-content">
                        <h3>Digitale Transformatie</h3>
                        <p>Lancering van ons volledig digitale platform om het huurproces te vereenvoudigen.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">2022</div>
                    <div class="timeline-content">
                        <h3>Groene Vloot</h3>
                        <p>Introductie van onze eerste volledig elektrische voertuigen in ons wagenpark.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">2025</div>
                    <div class="timeline-content">
                        <h3>Expansie</h3>
                        <p>Uitbreiding naar nieuwe steden en landen om meer mensen te bedienen.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* Onze Visie Page Styles */
    .page-container {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
    }
    
    /* Header Banner styling similar to hulp.php */
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
    
    .section-header {
        margin-bottom: 30px;
    }
    
    .section-header.centered {
        text-align: center;
    }
    
    .section-title {
        font-size: 2.2rem;
        color: #333;
        position: relative;
        display: inline-block;
        margin-bottom: 10px;
    }
    
    .section-header.centered .section-title:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #3563E9;
        border-radius: 3px;
    }
    
    .intro-text {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        font-size: 1.1rem;
        line-height: 1.6;
        color: #444;
        margin-bottom: 50px;
    }
    
    /* Vision Grid */
    .vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .vision-item {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .vision-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .vision-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: #3563E9;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 24px;
    }
    
    .vision-item h3 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
    }
    
    .vision-item p {
        color: #666;
        line-height: 1.6;
    }
    
    /* Quote Section */
    .quote-section {
        padding: 50px 0;
    }
    
    blockquote {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
        background-color: #f8f9fa;
        border-left: 5px solid #3563E9;
        border-radius: 10px;
        font-size: 1.5rem;
        font-style: italic;
        color: #333;
        position: relative;
    }
    
    blockquote:before {
        content: '"';
        font-size: 5rem;
        position: absolute;
        top: 10px;
        left: 10px;
        color: #e0e0e0;
        font-family: Georgia, serif;
    }
    
    blockquote cite {
        display: block;
        margin-top: 20px;
        font-size: 1rem;
        font-style: normal;
        color: #666;
        text-align: right;
    }
    
    /* Timeline */
    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px 0;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 3px;
        background-color: #3563E9;
        transform: translateX(-50%);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 50px;
        display: flex;
        align-items: center;
    }
    
    .timeline-item:nth-child(odd) {
        flex-direction: row-reverse;
    }
    
    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #3563E9;
        z-index: 1;
    }
    
    .timeline-date {
        width: 25%;
        padding: 0 20px;
        font-weight: bold;
        color: #3563E9;
        text-align: right;
    }
    
    .timeline-item:nth-child(odd) .timeline-date {
        text-align: left;
    }
    
    .timeline-content {
        width: 75%;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    .timeline-content h3 {
        margin-top: 0;
        color: #333;
    }
    
    .timeline-content p {
        margin-bottom: 0;
        color: #666;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .vision-grid {
            grid-template-columns: 1fr;
        }
        
        .timeline:before {
            left: 30px;
        }
        
        .timeline-item, .timeline-item:nth-child(odd) {
            flex-direction: column;
            align-items: flex-start;
            padding-left: 60px;
        }
        
        .timeline-dot {
            left: 30px;
        }
        
        .timeline-date, .timeline-item:nth-child(odd) .timeline-date {
            width: 100%;
            text-align: left;
            padding: 0;
            margin-bottom: 10px;
        }
        
        .timeline-content {
            width: 100%;
        }
        
        .banner-content h1 {
            font-size: 2.5rem;
        }
    }
</style>

<?php require __DIR__ . "/../includes/footer.php" ?>
