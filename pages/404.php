<?php require __DIR__ . "/../includes/header.php" ?>

<main class="error-page">
    <div class="error-container">
        <div class="error-content">
            <h1>404</h1>
            <h2>Pagina niet gevonden</h2>
            <p>De pagina die u zoekt bestaat niet of is verplaatst.</p>
            <a href="/" class="button-primary">Terug naar home</a>
        </div>
    </div>
</main>

<style>
.error-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fb;
}

.error-container {
    text-align: center;
    padding: 40px 20px;
}

.error-content h1 {
    font-size: 6rem;
    color: #3563E9;
    margin: 0;
    font-weight: 800;
    line-height: 1;
}

.error-content h2 {
    font-size: 2rem;
    color: #333;
    margin: 20px 0 10px 0;
    font-weight: 700;
}

.error-content p {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 30px;
}

@media (max-width: 768px) {
    .error-content h1 {
        font-size: 4rem;
    }
    
    .error-content h2 {
        font-size: 1.5rem;
    }
}
</style>

<?php require __DIR__ . "/../includes/footer.php" ?> 