{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Nouveau client'})}}
        <form action="{{ path }}client/store" method="post">
            <ul class="form-style-1">
                <li>
                    <label for = "lastName">Nom complet<span class="required">*</span></label>
                    <input type="text" name = "lastName" value="{{ data.lastName }}" placeholder="Nom de famille*" class="field-divided">
                    <input type="text" name = "firstName" value="{{ data.firstName }}" placeholder="Prénom*"class="field-divided">
                </li>
                <li>
                    <label for="email">Courriel<span class="required">*</span><span class="form-colonne-droite">Mot de passe</span><span class="required">*</span></label>
                    <input type="email" name = "email" value="{{ data.email }}" placeholder = "Courriel*" class="field-divided">
                    <input type="password" name = "password" placeholder = "Mot de passe*" class="field-divided">
                </li>
                <li>
                    <label for = "birthday">Anniversaire</label>
                    <input type="date" name = "birthday" value="{{ data.birthday }}" placeholder = "Date d'anniversaire" class="field-divided">
                    <select name="idCountry" class="field-divided">
                        <option value = "-1">- Choisissez un pays -</option>

                    {% for country in countries %}
                        <option value="{{country.idCountry}}">{{country.countryName}}</option>
                    {% endfor %}
                    </select>
                </li>
                <li>
                <!--    ** privilège par défaut des clients = 3
                        ** les employés vont entrer leur no employé à la main
                        <select name="idPriviledge" class="field-divided">
                        <option value = "-1">- Choisissez un privilege -</option>
                    {% for priviledge in priviledges %}
                        <option value="{{priviledge.id}}">{{priviledge.type}}</option>
                    {% endfor %}
                    </select>
                -->
                    <label for = "addresse">Adresse</label>
                    <input type="text" name = "addresse" value="{{ data.addresse }}" placeholder = "Adresse" class="field-divided">
                    <input type="number" name = "idEmployee" value="{{ data.idEmployee }}" placeholder = "Numéro d'employé, s'il y a lieu" class="field-divided">
                </li>
                <li>
                    <input type="submit" value = "créer">
                </li>
            </ul> 
        </form>
    </main>
</body>
</html>