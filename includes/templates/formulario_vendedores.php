<fieldset>
            <legend>Información general</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor" value="<?php echo sanitizar($vendedor->nombre); ?>">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor" value="<?php echo sanitizar($vendedor->apellido); ?>">

</fieldset>        

<fieldset>
    <legend>Información extra</legend>
    <label for="nombre">Teléfono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono vendedor" value="<?php echo sanitizar($vendedor->telefono); ?>">
</fieldset>