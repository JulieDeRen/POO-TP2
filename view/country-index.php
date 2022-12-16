{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste des pays'})}}
        <table>
            <thead>
                <tr>
                    <th>Nom des pays</th>
                </tr>
            </thead>
            <tbody>
                {% for country in countries %}
                        <tr>
                            <td><a href="{{ path }}country/show/{{ country.idCountry}}">{{ country.countryName }}</a></td>
                        </tr>
                {% endfor %}
                
            </tbody>
        </table>
    </main>
</body>
</html>