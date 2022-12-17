{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste de timbres'})}}
        <section class="les-grilles-page-main caroussel-portail">
            {% for basket in baskets %}
                <article class = "flexVertical carte">
                    <img src="{{ path }}{{ basket.imgPath }}" alt="Timbre">
                    <div>
                        <header>
                            <h2>{{ basket.stampName }}</h2>
                        </header>
                        <section>
                            <dl>
                                <dt>Date d'émission</dt>
                                    <dd>{{ basket.date }}</dd>
                                <dt>Prix demandé</dt>
                                    <dd>${{ basket.price }}</dd>
                                <dt>Estimation</dt>
                                    <dd>${{ basket.priceEstimation }}</dd>
                                <dt>Format</dt>
                                    <dd>{{ basket.formatName }}</dd>
                                <dt>Condition</dt>
                                    <dd>{{ basket.conditionName }}</dd>
                            </dl>
                            <div class="utilitaire-alinement-bouton-encherir">
                                {% if guest %}
                                <a href="{{ path }}user/login">Ajouter au panier</a>
                                {% else %}
                                <form action="{{ path }}basket/store" method="post">
                                    <input type="hidden" name = "id" value = "{{basket.id}}"><!-- id du timbre appel modelStamp dans le select pour create-->
                                    <input type="hidden" name = "price" value = "{{basket.price}}">
                                    <input type="submit" value = "Ajouter au panier">
                                </form>
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