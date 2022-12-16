{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Modifier'})}}
        <form action="{{ path }}user/update" method="post">
            <ul class="form-style-1">
                {% for user in users %}
                <li>
                    <input type="hidden" name="id" value="{{user.id}}">
                </li>
                <li>
                    <label for = "lastName">Nom Complet <span class="required">*</span></label>
                    <input type="text" name = "lastName" value="{{user.lastName}}" class="field-divided">
                    <input type="text" name = "firstName" value="{{user.firstName}}" class="field-divided">
                </li>
                <li>
                    <label for="email">Courriel<span class="required">*</span><span class="form-colonne-droite">Mot de passe</span><span class="required">*</span></label>
                    <input type="email" name = "email" value="{{user.email}}" class="field-divided">
                    <input type="password" name = "password" value="{{user.password}}" class="field-divided">
                </li>
                <li>
                    <label for = "birthday">Anniversaire</label>
                    <input type="date" name = "birthday" value="{{user.birthday}}" class="field-divided">
                {% endfor %}
                    
                    <select name="idPriviledge" class="field-divided">
                        <option value = "-1">- Choisissez un privilege -</option>
                        <!--Ajout d'une condition sélected -->
                {% for priviledge in priviledges %}
                        {% set selected = '' %}
                        {% for user in users %}
                            {% if (priviledge.id) == (user.idPriviledge) %}
                                {% set selected = 'selected' %}
                            {% endif %}
                        {% endfor %}
                        <option value="{{priviledge.id}}" {{selected}}>{{priviledge.type}}</option>
                {% endfor %}
                    </select>
                </li>
                <li>
                {% for user in users %}
                    <label for="addresse">Adresse</label>
                    <input type="text" name = "addresse" value="{{user.addresse}}" class="field-divided"> 
                {% endfor %}
                    <select name="idCountry" class="field-divided">
                        <option value = "-1">- Choisissez un pays -</option>

                {% for country in countries %}
                    {% set selected = '' %}
                        {% for user in users %}
                            {% if (country.idCountry) == (user.idCountry) %}
                                    {% set selected = 'selected' %}
                            {% endif %}
                        {% endfor %}
                        <option value="{{country.idCountry}}" {{selected}}>{{country.countryName}}</option>
                {% endfor %}
                  
                {% for user in users %}
                    </select>              
                </li>
                <li>
                    <input type="submit" value="Modifier">
                </li>
        </form>
        <form action="{{ path }}user/delete" method="post">
                <li>
                    <input type="hidden" name="id" value="{{user.id}}">
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
