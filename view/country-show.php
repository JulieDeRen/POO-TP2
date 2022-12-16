{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Modifier'})}}
        <form action="{{ path }}country/update" method="post">
            <ul class="form-style-1">
                {% for country in countries %}
                <li>
                    <input type="hidden" name="idCountry" value="{{country.idCountry}}">
                </li>
                <li>
                    <label for="countryName">Nom</label>
                    <input type="text" name = "countryName" value="{{country.countryName}}" class="field-long">
                </li>
                <li>
                    <input type="submit" value="Modifier">
                </li>
        </form>
        <form action="{{ path }}country/delete" method="post">
                <li>
                    <input type="hidden" name="idCountry" value="{{country.idCountry}}">
                </li>
                {% endfor %}
                <li>
                    <input type="submit" value="Effacer">
                </li>
            </ul>
        </form>
    </main>  
</body>
</html>
