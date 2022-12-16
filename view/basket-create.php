{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste de timbres'})}}
        <section class="les-grilles-page-main caroussel-portail">
            {% for stamp in stamps %}
                <article class = "flexVertical carte">
                    <img src="{{ path }}{{ stamp.imgPath }}" alt="Timbre">
                    <div>
                        <header>
                            <h2>{{ stamp.stampName }}</h2>
                        </header>
                        <section>
                            <dl>
                                <dt>Date d'émission</dt>
                                    <dd>{{ stamp.date }}</dd>
                                <dt>Prix demandé</dt>
                                    <dd>${{ stamp.price }}</dd>
                                <dt>Estimation</dt>
                                    <dd>${{ stamp.priceEstimation }}</dd>
                                <dt>Format</dt>
                                    <dd>{{ stamp.formatName }}</dd>
                                <dt>Condition</dt>
                                    <dd>{{ stamp.conditionName }}</dd>
                            </dl>
                            <div class="utilitaire-alinement-bouton-encherir">
                                {% if guest %}
                                <a href="{{ path }}user/login">Ajouter au panier</a>
                                {% else %}
                                <a href="{{ path }}basket/store">Ajouter au panier</a>
                                {% endif %}
                            </div>
                        </section>
                    </div>
                </article>
            {% endfor %}
        </section>
    </main>
    <footer>
        Tous les droits
    </footer>
    </body>
</html>