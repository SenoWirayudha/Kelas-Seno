<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayam Goreng Jos - Chatting</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Ayam Goreng Jos</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/profil">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="/order">Order</a></li>
                <li class="nav-item"><a class="nav-link" href="/kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="/chatting">Chatting</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Chatting Dengan Kami</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <button type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#chatModal">
                    Mulai Chat
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatModalLabel">Chat Dengan Customer Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="chat-box" style="height: 300px; overflow-y: auto; background-color: #f7f7f7; padding: 10px; border-radius: 10px;">
                        <!-- Pesan akan tampil di sini -->
                    </div>
                    <form id="chatForm" class="mt-3">
                        <div class="form-group">
                            <textarea class="form-control" id="chatMessage" rows="2" placeholder="Ketik pesan..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2025 Ayam Goreng Jos. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menangani pengiriman pesan di chat
        $(document).ready(function() {
            $("#chatForm").on("submit", function(e) {
                e.preventDefault();
                var message = $("#chatMessage").val();
                if (message) {
                    var messageHTML = "<div><strong>Pelanggan:</strong> " + message + "</div>";
                    $(".chat-box").append(messageHTML);
                    $("#chatMessage").val('');
                    $(".chat-box").scrollTop($(".chat-box")[0].scrollHeight);  // Scroll ke bawah
                }
            });
        });
    </script>
    </body>
</html>
