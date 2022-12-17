{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Votre pannier'})}}
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Titre du timbre</th>
                            <th>Date d'émission</th>
                            <th>Provenance</th>
                            <th>Condition</th>
                            <th>Format</th>
                            <th>Prix</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for basket in baskets %}
                        <tr>
                            <td>{{ basket.title }}</td>
                            <td>{{ basket.date }}</td>
                            <td>{{ basket.countryName }}</td>
                            <td>{{ basket.conditionName }}</td>
                            <td>{{ basket.formatName }}</td>
                            <td>{{ basket.price }}</td>
                            <td>
                                <form action="{{ path }}basket/delete/{{ basket.idStamp}}" method="post">
                                    <input type="hidden" name = "idStamp" value = "{{basket.idStamp}}">
                                    <input type="submit" value = "Effacer">
                                </form>
                            </td>
                        </tr>
                        {% endfor %}
                        <tr>
                            <td colspan="5">Total</td>
                            <td>{{ total }}</td>
                            <td colspan = "2"><a href="#">Commandez-maintenant</a></td>
                        </tr>
                    </tbody>
                    
                </table>
            </section>
        </main>
        <footer>
            Tous les droits
        </footer>
    </body>
</html>