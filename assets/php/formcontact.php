<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['demo-name'];
    $email = $_POST['demo-email'];
    $category = $_POST['demo-category'];
    $priority = $_POST['demo-priority'];
    $message = $_POST['demo-message'];
    $copy = isset($_POST['demo-copy']);

    $to = "contact@usvolleyballpont.fr";
    $subject = "Nouveau message via le formulaire de contact";
    $headers = "From: $email\r\n";
    
    if ($copy) {
        $headers .= "CC: $email\r\n";
    }
    
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Nom: $name\n";
    $body .= "Email: $email\n";
    $body .= "Catégorie: $category\n";
    $body .= "Priorité: $priority\n";
    $body .= "Message:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true, "message" => "Votre message a été envoyé avec succès."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'envoi du message."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Requête invalide."]);
}
?>
