<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['activo'] ? 'Sí' : 'No'; ?></td>
                <td>
                    <a href="index.php?action=editar&id=<?php echo $row['id']; ?>">Editar</a>
                    <form action="index.php?action=eliminar" method="post" onsubmit="return confirm('¿Está seguro?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
