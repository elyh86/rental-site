<?php require __DIR__ . "/../includes/header.php" ?>

<!-- Events Pagina -->
<div class="events-hero">
    <div class="events-hero-bg">
        <img src="/assets/images/banner.jpeg" alt="Rydr events banner">
        <div class="events-hero-overlay"></div>
    </div>
    <div class="events-hero-content">
        <h1>Rydr Events</h1>
        <p>Beleef mobiliteit, innovatie en community. Ontdek onze inspirerende events en doe mee!</p>
    </div>
</div>

<main class="events-main">
    <section class="events-intro">
        <h2>Welkom bij onze events</h2>
        <p>Van testritten tot workshops en inspirerende meetups: bij Rydr brengen we autoliefhebbers, ondernemers en mobiliteitsdenkers samen. Bekijk hieronder onze highlights en komende activiteiten.</p>
    </section>

    <!-- Featured Event -->
    <section class="events-featured">
        <div class="event-featured-card">
            <div class="event-featured-img">
                <img src="/assets/images/event-featured.jpg" alt="Rydr Fleet Launch Day" onerror="this.src='/assets/images/banner.jpeg'">
                <div class="event-featured-date">
                    <span class="day">12</span>
                    <span class="month">OKT</span>
                </div>
            </div>
            <div class="event-featured-info">
                <span class="event-featured-badge">Uitgelicht</span>
                <h3>Rydr Fleet Launch Day</h3>
                <div class="event-featured-details">
                    <span><i class="fa-solid fa-clock"></i> 10:00 - 17:00</span>
                    <span><i class="fa-solid fa-location-dot"></i> Rydr Experience Center, Amsterdam</span>
                </div>
                <p>Maak kennis met onze nieuwste huurauto's! Live demonstraties, proefritten en exclusieve aanbiedingen voor bezoekers.</p>
                <a href="#" class="button-primary">Gratis aanmelden</a>
            </div>
        </div>
    </section>

    <!-- Komende Events als tijdlijn -->
    <section class="events-upcoming">
        <h2>Komende events</h2>
        <ul class="events-timeline">
            <li class="timeline-event">
                <div class="timeline-date"><span>28 NOV</span></div>
                <div class="timeline-card">
                    <div class="event-card-img">
                        <img src="/assets/images/event1.jpg" alt="SUV Testdag" onerror="this.src='/assets/images/banner.jpeg'">
                    </div>
                    <div class="event-card-info">
                        <h3>SUV Testdag</h3>
                        <div class="event-card-details">
                            <span><i class="fa-solid fa-clock"></i> 09:00 - 18:00</span>
                            <span><i class="fa-solid fa-location-dot"></i> Testbaan Lelystad</span>
                        </div>
                        <p>Test verschillende SUV-modellen uit ons wagenpark. Inclusief deskundig advies en gratis snacks.</p>
                        <a href="#" class="button-primary">Aanmelden</a>
                    </div>
                </div>
            </li>
            <li class="timeline-event">
                <div class="timeline-date"><span>10 DEC</span></div>
                <div class="timeline-card">
                    <div class="event-card-img">
                        <img src="/assets/images/event2.jpg" alt="Zakelijk Leasen Info-avond" onerror="this.src='/assets/images/banner.jpeg'">
                    </div>
                    <div class="event-card-info">
                        <h3>Zakelijk Leasen Info-avond</h3>
                        <div class="event-card-details">
                            <span><i class="fa-solid fa-clock"></i> 18:00 - 21:00</span>
                            <span><i class="fa-solid fa-location-dot"></i> Rydr Business Lounge, Rotterdam</span>
                        </div>
                        <p>Alles over zakelijk leasen, fiscale voordelen en de nieuwste trends in mobiliteit.</p>
                        <a href="#" class="button-primary">Aanmelden</a>
                    </div>
                </div>
            </li>
            <li class="timeline-event">
                <div class="timeline-date"><span>23 DEC</span></div>
                <div class="timeline-card">
                    <div class="event-card-img">
                        <img src="/assets/images/event3.jpg" alt="Elektrisch Rijden Workshop" onerror="this.src='/assets/images/banner.jpeg'">
                    </div>
                    <div class="event-card-info">
                        <h3>Elektrisch Rijden Workshop</h3>
                        <div class="event-card-details">
                            <span><i class="fa-solid fa-clock"></i> 13:00 - 16:00</span>
                            <span><i class="fa-solid fa-location-dot"></i> Rydr Academy, Utrecht</span>
                        </div>
                        <p>Leer alles over elektrisch rijden, laden en het huren van EV's. Inclusief Q&A met experts.</p>
                        <a href="#" class="button-primary">Aanmelden</a>
                    </div>
                </div>
            </li>
            <li class="timeline-event">
                <div class="timeline-date"><span>6 JAN</span></div>
                <div class="timeline-card">
                    <div class="event-card-img">
                        <img src="/assets/images/event4.jpg" alt="Youngtimer Rally" onerror="this.src='/assets/images/banner.jpeg'">
                    </div>
                    <div class="event-card-info">
                        <h3>Youngtimer Rally</h3>
                        <div class="event-card-details">
                            <span><i class="fa-solid fa-clock"></i> 11:00 - 16:00</span>
                            <span><i class="fa-solid fa-location-dot"></i> Start: Rydr HQ, Den Bosch</span>
                        </div>
                        <p>Een gezellige rally met onze mooiste youngtimers. Voor liefhebbers en huurders!</p>
                        <a href="#" class="button-primary">Aanmelden</a>
                    </div>
                </div>
            </li>
        </ul>
    </section>

    <!-- Eerdere Events als horizontale cards -->
    <section class="events-past">
        <h2>Eerdere events</h2>
        <div class="events-past-row">
            <div class="past-event-item">
                <img src="/assets/images/past-event1.jpg" alt="Cabrio Zomer Tour" onerror="this.src='/assets/images/banner.jpeg'">
                <div class="past-event-overlay">
                    <h3>Cabrio Zomer Tour</h3>
                    <span>Juli 2024</span>
                </div>
            </div>
            <div class="past-event-item">
                <img src="/assets/images/past-event2.jpg" alt="Bedrijfswagen Demo-dag" onerror="this.src='/assets/images/banner.jpeg'">
                <div class="past-event-overlay">
                    <h3>Bedrijfswagen Demo-dag</h3>
                    <span>Mei 2024</span>
                </div>
            </div>
            <div class="past-event-item">
                <img src="/assets/images/past-event3.jpg" alt="Wintercheck Drive-in" onerror="this.src='/assets/images/banner.jpeg'">
                <div class="past-event-overlay">
                    <h3>Wintercheck Drive-in</h3>
                    <span>Januari 2024</span>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.events-hero {
    position: relative;
    width: 100vw;
    min-height: 320px;
    max-height: 420px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.events-hero-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0; left: 0;
    z-index: 1;
}
.events-hero-bg img {
    width: 100vw;
    height: 100%;
    object-fit: cover;
    display: block;
}
.events-hero-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(120deg, rgba(53,99,233,0.45) 0%, rgba(0,0,0,0.45) 100%);
    z-index: 2;
}
.events-hero-content {
    position: relative;
    z-index: 3;
    color: #fff;
    text-align: center;
    padding: 48px 20px 36px 20px;
}
.events-hero-content h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: -1px;
    text-shadow: 0 2px 16px rgba(0,0,0,0.18);
}
.events-hero-content p {
    font-size: 1.25rem;
    font-weight: 400;
    margin: 0 auto;
    max-width: 600px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.10);
}

.events-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px 20px;
}

.events-intro {
    margin-top: 60px;
    margin-bottom: 60px;
    text-align: center;
}
.events-intro h2 {
    font-size: 2rem;
    color: #3563E9;
    margin-bottom: 18px;
    font-weight: 700;
}
.events-intro p {
    color: #444;
    font-size: 1.08rem;
    line-height: 1.7;
    max-width: 700px;
    margin: 0 auto;
}

.events-featured {
    margin-bottom: 60px;
    display: flex;
    justify-content: center;
}
.event-featured-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(53,99,233,0.10);
    overflow: hidden;
    max-width: 900px;
    width: 100%;
}
.event-featured-img {
    position: relative;
    width: 100%;
    height: 260px;
    overflow: hidden;
}
.event-featured-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.event-featured-date {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #3563E9;
    color: #fff;
    border-radius: 10px;
    padding: 14px 18px;
    text-align: center;
    box-shadow: 0 2px 12px rgba(53,99,233,0.10);
}
.event-featured-date .day {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
}
.event-featured-date .month {
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.event-featured-info {
    padding: 36px 32px 32px 32px;
}
.event-featured-badge {
    display: inline-block;
    background: #FFD166;
    color: #333;
    padding: 6px 16px;
    border-radius: 6px;
    font-size: 0.92rem;
    font-weight: 700;
    margin-bottom: 16px;
}
.event-featured-info h3 {
    margin: 0 0 18px 0;
    color: #222;
    font-size: 1.7rem;
    font-weight: 800;
}
.event-featured-details {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-bottom: 18px;
    color: #3563E9;
    font-size: 1.05rem;
    font-weight: 600;
}
.event-featured-details i {
    margin-right: 7px;
}
.event-featured-info p {
    color: #555;
    font-size: 1.08rem;
    margin-bottom: 18px;
}

.events-timeline {
    position: relative;
    margin: 0 auto 60px auto;
    padding: 0;
    max-width: 700px;
    list-style: none;
}
.events-timeline:before {
    content: '';
    position: absolute;
    left: 32px;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #3563E9 0%, #eaf0ff 100%);
    border-radius: 2px;
    z-index: 0;
}
.timeline-event {
    display: flex;
    align-items: flex-start;
    position: relative;
    margin-bottom: 48px;
    min-height: 120px;
}
.timeline-date {
    position: relative;
    z-index: 2;
    width: 64px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}
.timeline-date span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 44px;
    background: #3563E9;
    color: #fff;
    font-weight: 700;
    font-size: 0.95rem;
    border-radius: 22px;
    box-shadow: 0 2px 8px rgba(53,99,233,0.10);
    margin-top: 0;
    margin-bottom: 0;
    text-align: center;
    line-height: 1.2;
    padding: 0 8px;
}
.timeline-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(53,99,233,0.06);
    margin-left: 24px;
    padding: 24px 22px 22px 22px;
    flex: 1;
    display: flex;
    gap: 24px;
    align-items: flex-start;
    transition: box-shadow 0.18s, transform 0.18s;
}
.timeline-card:hover {
    box-shadow: 0 12px 32px rgba(53,99,233,0.13);
    transform: translateY(-4px) scale(1.01);
}
.timeline-card .event-card-img {
    width: 120px;
    min-width: 120px;
    height: 90px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(53,99,233,0.08);
}
.timeline-card .event-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.timeline-card .event-card-info {
    flex: 1;
    padding: 0;
}
.timeline-card .event-card-info h3 {
    margin: 0 0 8px 0;
    color: #222;
    font-size: 1.18rem;
    font-weight: 700;
}
.timeline-card .event-card-details {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 8px;
    color: #3563E9;
    font-size: 0.98rem;
    font-weight: 600;
}
.timeline-card .event-card-details i {
    margin-right: 6px;
}
.timeline-card .event-card-info p {
    color: #555;
    font-size: 0.98rem;
    margin-bottom: 10px;
}

.events-past-row {
    display: flex;
    gap: 22px;
    margin-top: 18px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
    overflow-x: auto;
    padding-bottom: 10px;
}
.events-past-row .past-event-item {
    min-width: 220px;
    max-width: 240px;
    height: 160px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(53,99,233,0.04);
    background: #f8f9fb;
    position: relative;
    flex: 0 0 auto;
    transition: box-shadow 0.18s, transform 0.18s;
}
.events-past-row .past-event-item:hover {
    box-shadow: 0 8px 24px rgba(53,99,233,0.10);
    transform: translateY(-3px) scale(1.03);
}
.events-past-row .past-event-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.events-past-row .past-event-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 14px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}
.events-past-row .past-event-item:hover img {
    transform: scale(1.1);
}
.events-past-row .past-event-item:hover .past-event-overlay {
    transform: translateY(0);
}
.events-past-row .past-event-overlay h3 {
    margin: 0 0 5px;
    font-size: 1.1rem;
}
.events-past-row .past-event-overlay span {
    font-size: 0.92rem;
    opacity: 0.85;
}

@media (max-width: 1000px) {
    .events-main { padding: 0 8px 40px 8px; }
    .events-featured { margin-bottom: 36px; }
}
@media (max-width: 800px) {
    .events-hero-content h1 { font-size: 2.2rem; }
    .event-featured-info { padding: 24px 12px 18px 12px; }
    .events-timeline { max-width: 98vw; }
    .timeline-card { flex-direction: column; gap: 12px; }
    .timeline-card .event-card-img { width: 100%; min-width: 0; height: 120px; }
}
@media (max-width: 600px) {
    .events-hero { min-height: 180px; }
    .events-hero-content { padding: 24px 6px 18px 6px; }
    .events-main { padding: 0 2px 24px 2px; }
    .events-intro h2 { font-size: 1.2rem; }
    .timeline-event { margin-bottom: 32px; }
    .timeline-date { width: 60px; }
    .timeline-date span { width: 50px; height: 36px; font-size: 0.85rem; border-radius: 18px; }
    .timeline-card { padding: 14px 8px 12px 8px; }
}
</style>

<?php require __DIR__ . "/../includes/footer.php" ?>
