{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Nouveau timbre'})}}
        <form action="{{ path }}stamp/store" method="post" enctype="multipart/form-data">
            <ul class="form-style-1">
                <li>
                    <label for = "name">Nom du timbre<span class="required">*</span></label>
                    <input type="text" name = "name" placeholder="Nom du timbre*" class="field-long">
                </li>
                <li>
                    <label for="price">Valeur<span class="required">*</span></label>
                    <input type="number" name = "price" placeholder = "Prix actuel*" class="field-divided">
                    <input type="number" name = "priceEstimation" placeholder = "Estimation de la valeur" class="field-divided">
                </li>
                <li>
                    <label for = "date">Date émission</label>
                    <input type="date" name = "date" placeholder = "Date d'émission'" class="field-long">
                </li>
                <li>
                    <label for="description">Description du timbre</label>
                    <textarea name="description" id="description" placeholder = "Décrivez le timbre" class="field-long" cols="30" rows="10"></textarea>
                </li>
                <li>
                    <label for="idCountry">Pays</label>
                    <select name="idCountry" class="field-long">
                        <option value = "-1">- Choisissez un pays -</option>

                    {% for country in countries %}
                        <option value="{{country.idCountry}}">{{country.countryName}}</option>
                    {% endfor %}
                        
                    </select>
                </li>
                <li>
                    <label for = "idFormat">Format & Condition<span class="required">*</span></label>
                    <select name="idFormat" class="field-divided">
                        <option value = "-1">- Choisissez un format* -</option>

                    {% for format in formats %}
                        <option value="{{format.id}}">{{format.name}}</option>
                    {% endfor %}
                    </select>
                    <select name="idCondition" class="field-divided">
                        <option value = "-1">- Type de condition* -</option>

                    {% for condition in conditions %}
                        <option value="{{condition.id}}">{{condition.name}}</option>
                    {% endfor %}
                        
                    </select>
                </li>
                <li>
                    <label for = "fileToUpload">Image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="field-divided">
                </li>
                <li>
                    <input type="submit" value = "enregistrer">
                </li>
            </ul> 
        </form>
    </main>
</body>
</html>