<?php require "includes/header.php" ?>

<main class="help-main">
    <!-- Hero Section -->
    <div class="help-hero">
        <div class="hero-background">
            <img src="/assets/images/banner.jpeg" alt="Rydr Help" class="hero-image">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <div class="hero-text">
                <h1>Hulp & Ondersteuning</h1>
                <p>Wij staan voor u klaar met professionele service en snelle oplossingen</p>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Pechhulp</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">15 min</span>
                        <span class="stat-label">Reactietijd</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">4.8</span>
                        <span class="stat-label">Klanttevredenheid</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="container">
            <div class="actions-grid">
                <div class="action-card emergency">
                    <div class="action-icon">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <h3>Pech onderweg?</h3>
                    <p>24/7 pechhulp beschikbaar</p>
                    <a href="tel:+31612345678" class="action-btn emergency-btn">
                        <i class="fa fa-phone"></i> Bel nu: +31 6 1234 5678
                    </a>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fa fa-comments"></i>
                    </div>
                    <h3>Live Chat</h3>
                    <p>Direct contact met onze experts</p>
                    <button class="action-btn" onclick="openChat()">
                        <i class="fa fa-comment"></i> Start Chat
                    </button>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <h3>E-mail Support</h3>
                    <p>Binnen 2 uur antwoord</p>
                    <a href="mailto:support@rydr.nl" class="action-btn">
                        <i class="fa fa-envelope"></i> Stuur E-mail
                    </a>
                </div>
                
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <h3>Reservering wijzigen</h3>
                    <p>Wijzig of annuleer uw boeking</p>
                    <a href="/my-reservations" class="action-btn">
                        <i class="fa fa-calendar"></i> Bekijk Reserveringen
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Veelgestelde Vragen</h2>
                <p>Vind snel antwoord op uw vragen</p>
            </div>
            
            <div class="faq-search">
                <div class="search-container">
                    <i class="fa fa-search"></i>
                    <input type="text" id="faqSearch" placeholder="Zoek in veelgestelde vragen..." onkeyup="searchFAQ()">
                </div>
            </div>
            
            <div class="faq-categories">
                <button class="category-btn active" data-category="all">Alle vragen</button>
                <button class="category-btn" data-category="reservation">Reserveringen</button>
                <button class="category-btn" data-category="pickup">Ophalen & Terugbrengen</button>
                <button class="category-btn" data-category="insurance">Verzekering & Kosten</button>
                <button class="category-btn" data-category="emergency">Pech & Calamiteiten</button>
            </div>
            
            <div class="faq-list" id="faqList">
                <!-- Reservation FAQ -->
                <div class="faq-item" data-category="reservation">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Wat heb ik nodig om een auto te huren?</h3>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p>Om een auto te huren bij Rydr heeft u het volgende nodig:</p>
                            <div class="requirements-grid">
                                <div class="requirement-item">
                                    <i class="fa fa-id-card"></i>
                                    <div>
                                        <strong>Geldig rijbewijs</strong>
                                        <span>Minimaal 1 jaar in bezit</span>
                                    </div>
                                </div>
                                <div class="requirement-item">
                                    <i class="fa fa-passport"></i>
                                    <div>
                                        <strong>Legitimatiebewijs</strong>
                                        <span>ID-kaart of paspoort</span>
                                    </div>
                                </div>
                                <div class="requirement-item">
                                    <i class="fa fa-credit-card"></i>
                                    <div>
                                        <strong>Betaalmiddel</strong>
                                        <span>Creditcard of betaalpas op uw naam</span>
                                    </div>
                                </div>
                                <div class="requirement-item">
                                    <i class="fa fa-birthday-cake"></i>
                                    <div>
                                        <strong>Minimumleeftijd</strong>
                                        <span>21 jaar (25 jaar voor luxe auto's)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item" data-category="reservation">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Kan ik mijn reservering wijzigen of annuleren?</h3>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p>Ja, u kunt uw reservering wijzigen of annuleren onder de volgende voorwaarden:</p>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>Meer dan 48 uur voor aanvang</strong>
                                        <p>Kosteloze wijziging of volledige terugbetaling</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>24-48 uur voor aanvang</strong>
                                        <p>50% van de huursom wordt in rekening gebracht</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <strong>Minder dan 24 uur voor aanvang</strong>
                                        <p>Volledige huursom wordt in rekening gebracht</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pickup FAQ -->
                <div class="faq-item" data-category="pickup">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Hoe werkt het ophalen en terugbrengen van de auto?</h3>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <div class="process-grid">
                                <div class="process-step">
                                    <div class="step-number">1</div>
                                    <h4>Ophalen</h4>
                                    <ul>
                                        <li>Kom op afgesproken tijd naar onze locatie</li>
                                        <li>Neem rijbewijs, ID en betaalmiddel mee</li>
                                        <li>Gezamenlijke controle van de auto</li>
                                        <li>Ondertekening huurcontract</li>
                                        <li>Overhandiging sleutels</li>
                                    </ul>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">2</div>
                                    <h4>Terugbrengen</h4>
                                    <ul>
                                        <li>Breng auto terug op afgesproken tijd</li>
                                        <li>Zorg voor dezelfde hoeveelheid brandstof</li>
                                        <li>Gezamenlijke controle op schade</li>
                                        <li>Inleveren sleutels</li>
                                        <li>Verwerking administratie</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Insurance FAQ -->
                <div class="faq-item" data-category="insurance">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Zijn er extra kosten waar ik rekening mee moet houden?</h3>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <div class="costs-overview">
                                <div class="costs-included">
                                    <h4>Inbegrepen in de prijs:</h4>
                                    <ul>
                                        <li><i class="fa fa-check"></i> BTW</li>
                                        <li><i class="fa fa-check"></i> Basis verzekering (WA)</li>
                                        <li><i class="fa fa-check"></i> Normale slijtage</li>
                                    </ul>
                                </div>
                                <div class="costs-extra">
                                    <h4>Mogelijke extra kosten:</h4>
                                    <ul>
                                        <li><i class="fa fa-plus"></i> Aanvullende verzekeringen (€15/dag)</li>
                                        <li><i class="fa fa-plus"></i> Extra bestuurder (€7,50/dag)</li>
                                        <li><i class="fa fa-plus"></i> Kinderzitje/Navigatie (€5/dag)</li>
                                        <li><i class="fa fa-plus"></i> Te laat inleveren (€20/uur)</li>
                                        <li><i class="fa fa-plus"></i> Onvoldoende brandstof (€15 + kosten)</li>
                                        <li><i class="fa fa-plus"></i> Reinigingskosten (€50)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Emergency FAQ -->
                <div class="faq-item" data-category="emergency">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Wat moet ik doen bij pech onderweg?</h3>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <div class="emergency-steps">
                                <div class="emergency-step">
                                    <div class="step-icon">
                                        <i class="fa fa-shield-alt"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>1. Veiligheid eerst</h4>
                                        <p>Zet de auto veilig aan de kant, zet alarmlichten aan en plaats gevarendriehoek</p>
                                    </div>
                                </div>
                                <div class="emergency-step">
                                    <div class="step-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>2. Bel pechhulp</h4>
                                        <p>Bel onze 24/7 pechhulplijn: <a href="tel:+31612345678">+31 6 1234 5678</a></p>
                                    </div>
                                </div>
                                <div class="emergency-step">
                                    <div class="step-icon">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>3. Locatie doorgeven</h4>
                                        <p>Deel uw exacte locatie via navigatie-app of wegmarkeringen</p>
                                    </div>
                                </div>
                                <div class="emergency-step">
                                    <div class="step-icon">
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>4. Wacht op hulp</h4>
                                        <p>Blijf bij de auto tot de wegenwacht of sleepdienst arriveert</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Neem Contact Op</h2>
                    <p>Onze klantenservice staat voor u klaar om al uw vragen te beantwoorden.</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="method-info">
                                <h4>Telefoon</h4>
                                <p>Maandag - Vrijdag: 08:00 - 18:00</p>
                                <a href="tel:+31881234567">+31 88 123 4567</a>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="method-info">
                                <h4>E-mail</h4>
                                <p>Reactie binnen 2 uur</p>
                                <a href="mailto:support@rydr.nl">support@rydr.nl</a>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fa fa-map-marker-alt"></i>
                            </div>
                            <div class="method-info">
                                <h4>Adres</h4>
                                <p>Hoofdkantoor Rotterdam</p>
                                <span>Hoofdstraat 123, 3000 AA Rotterdam</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Stuur ons een bericht</h3>
                    <form action="/contact-submit" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Naam *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Onderwerp *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Kies een onderwerp</option>
                                <option value="reservation">Reservering</option>
                                <option value="technical">Technische vraag</option>
                                <option value="billing">Facturatie</option>
                                <option value="complaint">Klacht</option>
                                <option value="other">Overig</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Bericht *</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Beschrijf uw vraag of probleem..."></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fa fa-paper-plane"></i>
                            Verstuur Bericht
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// FAQ Toggle Function
function toggleFAQ(element) {
    const faqItem = element.parentElement;
    const answer = faqItem.querySelector('.faq-answer');
    const icon = element.querySelector('i');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-item').forEach(item => {
        if (item !== faqItem) {
            item.classList.remove('active');
            item.querySelector('.faq-answer').style.maxHeight = '0px';
            item.querySelector('i').className = 'fa fa-chevron-down';
        }
    });
    
    // Toggle current FAQ item
    faqItem.classList.toggle('active');
    
    if (faqItem.classList.contains('active')) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.className = 'fa fa-chevron-up';
    } else {
        answer.style.maxHeight = '0px';
        icon.className = 'fa fa-chevron-down';
    }
}

// FAQ Search Function
function searchFAQ() {
    const searchTerm = document.getElementById('faqSearch').value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('h3').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// FAQ Category Filter
document.querySelectorAll('.category-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const category = this.getAttribute('data-category');
        
        // Update active button
        document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Filter FAQ items
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

// Chat Function
function openChat() {
    alert('Live chat wordt binnenkort beschikbaar. Neem contact op via telefoon of e-mail.');
}
</script>

<style>
.help-main {
    min-height: 100vh;
    background: #f8f9fb;
}

/* Hero Section */
.help-hero {
    position: relative;
    height: 500px;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(53,99,233,0.8) 0%, rgba(0,0,0,0.6) 100%);
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 3;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 40px;
}

.hero-text h1 {
    font-size: 3.5rem;
    color: white;
    margin: 0 0 15px 0;
    font-weight: 800;
    letter-spacing: -1px;
}

.hero-text p {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin: 0;
    max-width: 500px;
}

.hero-stats {
    display: flex;
    gap: 30px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.2);
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.stat-info {
    color: white;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 2px;
}

/* Quick Actions */
.quick-actions {
    background: white;
    padding: 60px 0;
    margin-top: -50px;
    position: relative;
    z-index: 4;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.action-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.action-card.emergency {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.action-icon {
    width: 60px;
    height: 60px;
    background: #f8f9fb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
    color: #3563E9;
}

.action-card.emergency .action-icon {
    background: rgba(255,255,255,0.2);
    color: white;
}

.action-card h3 {
    font-size: 1.3rem;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.action-card p {
    color: #666;
    margin: 0 0 20px 0;
    font-size: 0.95rem;
}

.action-card.emergency p {
    color: rgba(255,255,255,0.8);
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #3563E9;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.action-btn:hover {
    background: #2d5bd8;
    transform: translateY(-1px);
}

.emergency-btn {
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.3);
}

.emergency-btn:hover {
    background: rgba(255,255,255,0.3);
}

/* FAQ Section */
.faq-section {
    padding: 80px 0;
    background: white;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h2 {
    font-size: 2.5rem;
    color: #333;
    margin: 0 0 10px 0;
    font-weight: 800;
}

.section-header p {
    color: #666;
    font-size: 1.1rem;
    margin: 0;
}

.faq-search {
    margin-bottom: 30px;
}

.search-container {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
}

.search-container i {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    font-size: 1.1rem;
}

#faqSearch {
    width: 100%;
    padding: 16px 20px 16px 50px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: border-color 0.2s ease;
}

#faqSearch:focus {
    outline: none;
    border-color: #3563E9;
}

.faq-categories {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.category-btn {
    padding: 10px 20px;
    background: #f8f9fb;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    color: #666;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.category-btn:hover,
.category-btn.active {
    background: #3563E9;
    border-color: #3563E9;
    color: white;
}

.faq-list {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    margin-bottom: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.faq-question {
    padding: 25px 30px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.2s ease;
}

.faq-question:hover {
    background: #f8f9fb;
}

.faq-question h3 {
    font-size: 1.1rem;
    margin: 0;
    font-weight: 600;
    color: #333;
}

.faq-question i {
    color: #3563E9;
    transition: transform 0.2s ease;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.answer-content {
    padding: 0 30px 25px;
    color: #666;
    line-height: 1.6;
}

/* FAQ Content Styles */
.requirements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.requirement-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fb;
    border-radius: 8px;
}

.requirement-item i {
    width: 40px;
    height: 40px;
    background: #3563E9;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.requirement-item strong {
    display: block;
    color: #333;
    margin-bottom: 2px;
}

.requirement-item span {
    font-size: 0.9rem;
    color: #666;
}

.timeline {
    margin-top: 20px;
}

.timeline-item {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    align-items: flex-start;
}

.timeline-marker {
    width: 12px;
    height: 12px;
    background: #3563E9;
    border-radius: 50%;
    margin-top: 8px;
    flex-shrink: 0;
}

.timeline-content strong {
    display: block;
    color: #333;
    margin-bottom: 5px;
}

.process-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 20px;
}

.process-step {
    background: #f8f9fb;
    padding: 25px;
    border-radius: 12px;
    position: relative;
}

.step-number {
    width: 40px;
    height: 40px;
    background: #3563E9;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-bottom: 15px;
}

.process-step h4 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.1rem;
}

.process-step ul {
    margin: 0;
    padding-left: 20px;
}

.process-step li {
    margin-bottom: 8px;
    color: #666;
}

.costs-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 20px;
}

.costs-included,
.costs-extra {
    background: #f8f9fb;
    padding: 25px;
    border-radius: 12px;
}

.costs-included h4,
.costs-extra h4 {
    margin: 0 0 15px 0;
    color: #333;
}

.costs-included ul,
.costs-extra ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.costs-included li,
.costs-extra li {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    color: #666;
}

.costs-included i {
    color: #28a745;
}

.costs-extra i {
    color: #dc3545;
}

.emergency-steps {
    margin-top: 20px;
}

.emergency-step {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    align-items: flex-start;
}

.step-icon {
    width: 50px;
    height: 50px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.step-content h4 {
    margin: 0 0 8px 0;
    color: #333;
}

.step-content p {
    margin: 0;
    color: #666;
}

.step-content a {
    color: #dc3545;
    text-decoration: none;
    font-weight: 600;
}

/* Contact Section */
.contact-section {
    background: #f8f9fb;
    padding: 80px 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

.contact-info h2 {
    font-size: 2.2rem;
    color: #333;
    margin: 0 0 15px 0;
    font-weight: 800;
}

.contact-info p {
    color: #666;
    font-size: 1.1rem;
    margin: 0 0 40px 0;
}

.contact-methods {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.contact-method {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}

.method-icon {
    width: 50px;
    height: 50px;
    background: #3563E9;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.method-info h4 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 1.1rem;
}

.method-info p {
    margin: 0 0 5px 0;
    color: #666;
    font-size: 0.9rem;
}

.method-info a {
    color: #3563E9;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
}

.method-info span {
    color: #666;
    font-size: 0.9rem;
}

.contact-form {
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.contact-form h3 {
    font-size: 1.5rem;
    color: #333;
    margin: 0 0 30px 0;
    font-weight: 700;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3563E9;
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.submit-btn {
    width: 100%;
    padding: 15px;
    background: #3563E9;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background-color 0.2s ease;
}

.submit-btn:hover {
    background: #2d5bd8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content {
        flex-direction: column;
        text-align: center;
        gap: 30px;
    }
    
    .hero-text h1 {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 15px;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .faq-categories {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .category-btn {
        white-space: nowrap;
    }
    
    .process-grid,
    .costs-overview {
        grid-template-columns: 1fr;
    }
    
    .requirements-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php require "includes/footer.php" ?>
