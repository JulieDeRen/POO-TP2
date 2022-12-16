<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ path }}css/stylesheet.css">
        <title>{{ title }}</title>
    </head>
    <body>
        <nav class="navigation">
            <div class="logo"><a href="{{ path }}"class="logo"><img src="{{ path }}uploads/logo.png" alt="logo"></a></div>
            <!--<a href="{{ path }}client/index">Registre des clients</a>-->
            {% if admin %}
            <a href="{{ path }}user/create">Ajouter un utilisateur</a>
            <a href="{{ path }}stamp/index">Registre des timbres</a>
            <a href="{{ path }}user/index">Registre des utilisateurs</a>
            <a href="{{ path }}session">Registre des sessions</a>
                {% if guest %}
                    <a href="{{path}}user/login">Login</a>
                {% else %}
                    <a href="{{path}}user/logout">Logout</a>
                {% endif %}
            <button class="menu-button dropdown"> ...
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="{{ path }}stamp/create">Ajouter timbre</a>
                    <a href="{{ path }}country/create">Ajouter un pays</a>
                    <a href="{{ path }}country/index">Liste pays</a>
                    <a href="{{ path }}format/create">Ajouter format</a>
                    <a href="{{ path }}format/index">Liste formats</a>
                    <a href="{{ path }}condition/create">Ajouter condition</a>
                    <a href="{{ path }}condition/index">Liste conditions</a>
                    <a href="{{ path }}priviledge/create">Ajouter privilège</a>
                    <a href="{{ path }}priviledge/index">Liste privilèges</a>
                    <a href="{{ path }}uxui_maquette_catalogue/">Site web</a>
                </div>
            </button>
            {% else %}
            <a href="{{ path }}client/create">Créer un compte</a>
            <a href="{{ path }}basket/create">Voir les timbres</a>
            <a href="{{ path }}stamp/index">Registre des timbres</a>
            <a href="{{ path }}format/index">Liste formats</a>
            <a href="{{ path }}condition/index">Liste conditions des timbres</a>
                {% if guest %}
                    <a href="{{path}}user/login">Login</a>
                {% else %}
                    <a href="{{path}}user/logout">Logout</a>
                {% endif %}
            {% endif %}
        </nav>
        <header class="entete-principal">
            <img src="{{ path }}uploads/stamp_queen_1400.jpg" alt="Timbres">
            <h1>{{ pageHeader }}</h1>
        </header>
        <main>
        {% if errors is defined %}
            <span class="error">{{ errors | raw}}</span>
        {% endif %}