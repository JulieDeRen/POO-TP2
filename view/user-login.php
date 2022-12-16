{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Login'})}}
        <form action="{{ path }}user/auth" method="post">
            <ul class="form-style-1">
                <li>
                    <label for = "email">Courriel<span class="required">*</span></label>
                    <input type="email" name = "email" value="{{ user.email }}" placeholder="Courriel*" class="field-long">
                </li>
                <li>
                    <label for = "password">Mot de passe<span class="required">*</span></label>
                    <input type="password" name = "password" placeholder="Mot de passe*" class="field-long">
                </li>
                <li>
                    <input type="submit" value="Connecter">
                </li>
            </ul>
        </form>
    </main>
</body>
</html>