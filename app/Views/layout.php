<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Banjaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('icon.png') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="<?= base_url('css/chatbot.css') ?>">
</head>

<body>
    <?= $this->include('components/header') ?>
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Chatbot HTML -->
    <button class="chatbot-toggler">
        <span class="material-symbols-outlined">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
    </button>

    <div class="chatbot">
        <header>
            <h2>Asisten Desa</h2>
        </header>

        <ul class="chatbox">
            <li class="chat incoming">
                <img src="<?= base_url('icon.png') ?>" alt="Bot Icon">
                <p>Halo! 👋<br>Ada yang bisa saya bantu tentang Desa Wisata Banjaran?</p>
            </li>
        </ul>

        <div class="chat-input">
            <textarea placeholder="Ketik pesan..." required></textarea>
            <span id="send-btn" class="material-symbols-outlined">send</span>
        </div>
    </div>

    <?= $this->include('components/footer') ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var baseURL = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url('js/chatbot.js') ?>?v=<?= time() ?>"></script>
</body>

</html>