<?php
if (isset($tema) && $tema) {
?>
    <form action="index.php?action=editar&id=<?php echo $tema['id']; ?>" method="post">
      <input type="hidden" name="id" value="<?php echo $tema['id']; ?>">
      <input type="text" name="nombre" value="<?php echo $tema['nombre']; ?>" required>
      <textarea name="descripcion"><?php echo $tema['descripcion']; ?></textarea>
      <input type="text" name="tipo" value="<?php echo $tema['tipo']; ?>" required>
      <input type="checkbox" name="activo" <?php echo $tema['activo'] ? 'checked' : ''; ?>> Activo<br>
      <button type="submit">Actualizar Tema</button>
    </form>
<?php
} else {
    echo "Error: No se encontraron los datos del tema para editar.";
}
?>
