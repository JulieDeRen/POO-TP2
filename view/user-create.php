{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Nouvel utilisateur'})}}
        <span class="error">{{ errors|raw }}</span>
        <form action="{{ path }}client/store" method="post">
            <ul class="form-style-1">
                <li>
                    <label for = "lastName">Nom complet<span class="required">*</span></label>
                    <input type="text" name = "lastName" placeholder="Nom de famille*" class="field-divided">
                    <input type="text" name = "firstName" placeholder="Prénom*"class="field-divided">
                </li>
                <li>
                    <label for="email">Courriel<span class="required">*</span><span class="form-colonne-droite">Mot de passe</span><span class="required">*</span></label>
                    <input type="email" name = "email" placeholder = "Courriel*" class="field-divided">
                    <input type="password" name = "password" placeholder = "Mot de passe*" class="field-divided">
                </li>
                <li>
                    <label for = "birthday">Anniversaire</label>
                    <input type="date" name = "birthday" placeholder = "Date d'anniversaire" class="field-divided">
                    <select name="idCountry" class="field-divided">
                        <option value = "-1">- Choisissez un pays -</option>

                    {% for country in countries %}
                        <option value="{{country.idCountry}}">{{country.countryName}}</option>
                    {% endfor %}
                    </select>
                </li>
                <li>
                <label for = "addresse">Adresse</label>
                    <input type="text" name = "addresse" placeholder = "Adresse" class="field-divided">
                    <select name="idPriviledge" class="field-divided">
                        <option value = "-1">- Choisissez un privilege -</option>
                    {% for priviledge in priviledges %}
                        <option value="{{priviledge.id}}">{{priviledge.type}}</option>
                    {% endfor %}
                    </select>
                </li>
                <li>
                    <input type="submit" value = "créer">
                </li>
            </ul> 
        </form>
    </main>
</body>
</html>