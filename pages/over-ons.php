<?php require "includes/header.php" ?>

<!-- Over Ons Pagina -->
<div class="overons-hero">
    <div class="overons-hero-bg">
        <img src="/assets/images/banner.jpeg" alt="Rydr banner">
        <div class="overons-hero-overlay"></div>
    </div>
    <div class="overons-hero-content">
        <h1>Over Rydr</h1>
        <p>Innovatie, service en mobiliteit – dat is waar wij voor staan. Ontdek wie wij zijn en wat ons drijft.</p>
    </div>
</div>

<main class="overons-main">
    <section class="overons-intro">
        <div class="overons-intro-inner">
            <div class="overons-intro-text">
                <h2>Onze Missie</h2>
                <p>Bij Rydr geloven we in flexibele mobiliteit voor iedereen. Of het nu gaat om een weekendje weg, een zakenreis, of het vervoeren van grote spullen met een bedrijfswagen – wij staan voor je klaar met de beste service en een uitgebreid wagenpark. Vanuit ons hoofdkantoor in Rotterdam werken we elke dag aan de mobiliteit van morgen.</p>
            </div>
            <div class="overons-intro-img">
                <img src="assets/images/work-place.png" alt="Rydr werkplek">
            </div>
        </div>
    </section>

    <section class="overons-team">
        <h2 class="overons-section-title">Het Team</h2>
        <p class="overons-team-intro">Maak kennis met ons toegewijde team van professionals die elke dag werken aan de beste auto-huurervaring voor onze klanten. Met jarenlange ervaring in de mobiliteitssector én een passie voor service, staan zij voor je klaar.</p>
        <div class="overons-team-grid">
            <!-- Team Member Card 1 -->
            <div class="overons-team-card">
                <div class="overons-team-img">
                    <img src="assets/images/team/jasper-van-den-brink.png" alt="Jasper van den Brink">
                </div>
                <div class="overons-team-info">
                    <h3>Jasper van den Brink</h3>
                    <span>Oprichter & CEO</span>
                    <p>Jasper richtte Rydr op in 2018 met een visie om autoverhuur toegankelijker te maken. Met zijn achtergrond in technologie en mobiliteit bouwt hij aan de toekomst van Rydr.</p>
                </div>
            </div>
            <!-- Team Member Card 2 -->
            <div class="overons-team-card">
                <div class="overons-team-img">
                    <img src="assets/images/team/lotte-de-graaf.png" alt="Lotte de Graaf">
                </div>
                <div class="overons-team-info">
                    <h3>Lotte de Graaf</h3>
                    <span>Operations Manager</span>
                    <p>Lotte zorgt ervoor dat alles soepel verloopt, van reserveringen tot het onderhoud van onze voertuigen. Haar focus op kwaliteit maakt het verschil voor onze klanten.</p>
                </div>
            </div>
            <!-- Team Member Card 3 -->
            <div class="overons-team-card">
                <div class="overons-team-img">
                    <img src="assets/images/team/brian-mensah.png" alt="Brian Mensah">
                </div>
                <div class="overons-team-info">
                    <h3>Brian Mensah</h3>
                    <span>Marketing Specialist</span>
                    <p>Brian vertelt het verhaal van Rydr aan de wereld. Met zijn creatieve aanpak zorgt hij ervoor dat we opvallen in de drukke markt van autoverhuur.</p>
                </div>
            </div>
            <!-- Team Member Card 4 -->
            <div class="overons-team-card">
                <div class="overons-team-img">
                    <img src="assets/images/team/youssef-amrani.png" alt="Youssef Amrani">
                </div>
                <div class="overons-team-info">
                    <h3>Youssef Amrani</h3>
                    <span>Technisch Directeur</span>
                    <p>Youssef leidt onze technische ontwikkeling. Zijn innovatieve oplossingen maken het huren van een auto via Rydr een eenvoudige en plezierige ervaring.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="overons-cta">
        <div class="overons-cta-inner">
            <h2>Word onderdeel van ons team</h2>
            <p>Wij zijn altijd op zoek naar gedreven professionals die ons team komen versterken. Bekijk onze vacatures of neem contact met ons op om de mogelijkheden te bespreken.</p>
            <a href="/vacatures" class="button-primary">Bekijk vacatures</a>
        </div>
    </section>
</main>

<style>
/***** Hero *****/
.overons-hero {
    position: relative;
    width: 100vw;
    min-height: 320px;
    max-height: 420px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.overons-hero-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0; left: 0;
    z-index: 1;
}
.overons-hero-bg img {
    width: 100vw;
    height: 100%;
    object-fit: cover;
    display: block;
}
.overons-hero-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(120deg, rgba(53,99,233,0.45) 0%, rgba(0,0,0,0.45) 100%);
    z-index: 2;
}
.overons-hero-content {
    position: relative;
    z-index: 3;
    color: #fff;
    text-align: center;
    padding: 40px 20px 30px 20px;
}
.overons-hero-content h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: -1px;
    text-shadow: 0 2px 16px rgba(0,0,0,0.18);
}
.overons-hero-content p {
    font-size: 1.25rem;
    font-weight: 400;
    margin: 0 auto;
    max-width: 600px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.10);
}

/***** Main Layout *****/
.overons-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px 20px;
}

/***** Introductie *****/
.overons-intro {
    margin-top: 60px;
    margin-bottom: 80px;
}
.overons-intro-inner {
    display: flex;
    gap: 60px;
    align-items: center;
    flex-wrap: wrap;
}
.overons-intro-text {
    flex: 1 1 320px;
}
.overons-intro-text h2 {
    font-size: 2rem;
    color: #3563E9;
    margin-bottom: 18px;
    font-weight: 700;
}
.overons-intro-text p {
    color: #444;
    font-size: 1.08rem;
    line-height: 1.7;
}
.overons-intro-img {
    flex: 1 1 320px;
    text-align: center;
}
.overons-intro-img img {
    width: 100%;
    max-width: 420px;
    border-radius: 14px;
    box-shadow: 0 8px 32px rgba(53,99,233,0.08);
}

/***** Team *****/
.overons-team {
    margin-bottom: 80px;
}
.overons-section-title {
    text-align: center;
    font-size: 2.2rem;
    color: #333;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: -1px;
    position: relative;
}
.overons-section-title:after {
    content: '';
    display: block;
    margin: 16px auto 0 auto;
    width: 80px;
    height: 3px;
    background: #3563E9;
    border-radius: 3px;
}
.overons-team-intro {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 40px auto;
    color: #555;
    font-size: 1.08rem;
    line-height: 1.7;
}
.overons-team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 32px;
    margin: 0 auto;
    max-width: 1000px;
}
.overons-team-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 32px rgba(53,99,233,0.07);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.25s, box-shadow 0.25s;
    border: 1px solid #f0f2fa;
}
.overons-team-card:hover {
    transform: translateY(-8px) scale(1.025);
    box-shadow: 0 16px 40px rgba(53,99,233,0.13);
}
.overons-team-img {
    width: 100%;
    max-width: 180px;
    aspect-ratio: 1/1;
    margin: 32px auto 0 auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(53,99,233,0.10);
    background: #f6f8ff;
    display: flex;
    align-items: center;
    justify-content: center;
}
.overons-team-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.overons-team-info {
    padding: 24px 24px 32px 24px;
    text-align: center;
}
.overons-team-info h3 {
    margin: 0 0 6px 0;
    color: #222;
    font-size: 1.18rem;
    font-weight: 700;
}
.overons-team-info span {
    display: block;
    color: #3563E9;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 12px;
}
.overons-team-info p {
    color: #666;
    font-size: 0.98rem;
    line-height: 1.6;
    margin: 0;
}

/***** CTA *****/
.overons-cta {
    background: linear-gradient(120deg, #f8f9fa 60%, #eaf0ff 100%);
    border-radius: 18px;
    padding: 60px 30px;
    text-align: center;
    margin: 0 auto;
    max-width: 800px;
    box-shadow: 0 4px 24px rgba(53,99,233,0.06);
}
.overons-cta-inner h2 {
    margin-top: 0;
    margin-bottom: 18px;
    color: #333;
    font-size: 2rem;
    font-weight: 700;
}
.overons-cta-inner p {
    margin-bottom: 30px;
    color: #555;
    line-height: 1.7;
}
.button-primary {
    display: inline-block;
    padding: 14px 36px;
    background: #3563E9;
    color: #fff;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.08rem;
    transition: background 0.2s;
    box-shadow: 0 2px 12px rgba(53,99,233,0.10);
    border: none;
    cursor: pointer;
}
.button-primary:hover {
    background: #2747b0;
}

/***** Responsive *****/
@media (max-width: 1000px) {
    .overons-main { padding: 0 8px 40px 8px; }
    .overons-intro-inner { gap: 30px; }
    .overons-team-grid { gap: 18px; }
}
@media (max-width: 800px) {
    .overons-hero-content h1 { font-size: 2.2rem; }
    .overons-intro-inner { flex-direction: column; gap: 18px; }
    .overons-intro-img img { max-width: 320px; }
    .overons-team-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
    .overons-hero { min-height: 180px; }
    .overons-hero-content { padding: 24px 6px 18px 6px; }
    .overons-main { padding: 0 2px 24px 2px; }
    .overons-section-title { font-size: 1.3rem; }
    .overons-team-grid { grid-template-columns: 1fr; }
    .overons-team-card { margin: 0 auto; max-width: 340px; }
    .overons-cta { padding: 32px 8px; }
}
</style>

<?php require "includes/footer.php" ?>
