<?php

namespace Tests\Unitaires;

use PHPUnit\Framework\TestCase;
use src\Controllers\ContactController;

class ContactControllerTest extends TestCase
{
    public function testSendContactAllFieldsValid()
    {
        $methodeContactController = new ContactController();
        $test = $methodeContactController->sendContact(
            'Doe',
            'John',
            'john.doe@example.com',
            'Ceci est un message valide.'
        );

        $expectedResponse = json_encode(['status' => 'success', 'message' => 'Votre message a bien été envoyé !']);
        $this->assertSame($expectedResponse, $test, "L'envoie du contact devrait être un succès.");
    }

    public function testSendContactMissingFields()
    {
        $methodeContactController = new ContactController();
        $test = $methodeContactController->sendContact(
            '',
            'John',
            'john.doe@example.com',
            'Ceci est un message valide.'
        );

        $expectedResponse = json_encode(['status' => 'error', 'message' => 'Merci de remplir tous les champs.']);
        $this->assertSame($expectedResponse, $test, "L'envoie du contact devrait être une erreur, champ manquant.");
    }

    public function testSendContactInvalidEmail()
    {
        $methodeContactController = new ContactController();
        $test = $methodeContactController->sendContact(
            'Doe',
            'John',
            'invalidemail',
            'Ceci est un message valide.'
        );

        $expectedResponse = json_encode(['status' => 'error', 'message' => 'Merci de rentrer un email valide.']);
        $this->assertSame($expectedResponse, $test, "L'envoie du contact devrait être une erreur, email invalide.");
    }

    public function testSendContactLastnameTooLong()
    {
        $methodeContactController = new ContactController();
        $test = $methodeContactController->sendContact(
            'Lorem ipsum dolor sit amet, consectetur erat curae.',
            'John',
            'john.doe@example.com',
            'Ceci est un message valide.'
        );

        $expectedResponse = json_encode(['status' => 'error', 'message' => 'Votre nom doit faire au maximum 50 caractères.']);
        $this->assertSame($expectedResponse, $test, "L'envoie du contact devrait être une erreur, nom trop long.");
    }

    public function testSendContactFirstnameTooLong()
    {
        $methodeContactController = new ContactController();
        $test = $methodeContactController->sendContact(
            'Doe',
            'Lorem ipsum dolor sit amet, consectetur erat curae.',
            'john.doe@example.com',
            'Ceci est un message valide.'
        );

        $expectedResponse = json_encode(['status' => 'error', 'message' => 'Votre prénom doit faire au maximum 50 caractères.']);
        $this->assertSame($expectedResponse, $test, "L'envoie du contact devrait être une erreur, prénom trop long.");
    }

    public function testSendContactMessageTooLong()
    {
        $methodeContactController = new ContactController();
        $test = $methodeContactController->sendContact(
            'Doe',
            'John',
            'john.doe@example.com',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dignissim viverra dolor. Donec vestibulum pharetra accumsan. Nullam convallis venenatis consectetur. Aliquam erat volutpat. Nam in mauris rutrum, commodo orci at, sodales enim. Maecenas aliquam, tellus vitae molestie iaculis, enim ipsum sagittis libero, aliquam accumsan purus diam at diam. Praesent nulla mi, porttitor id vulputate ut, tristique sed diam. Sed maximus, est nec luctus fringilla, magna diam ullamcorper urna, et proin.'
        );

        $expectedResponse = json_encode(['status' => 'error', 'message' => 'Le message doit faire au maximum 500 caractères.']);
        $this->assertSame($expectedResponse, $test, "L'envoie du contact devrait être une erreur, message trop long.");
    }
}
