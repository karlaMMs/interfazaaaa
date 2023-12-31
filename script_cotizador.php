<?php
include "conexion.php";

// Obtener la pregunta del usuario
$pregunta = $_POST['pregunta'];

// Buscar palabras clave en la pregunta
$palabras_clave = array(
    "precio", "costo", "oferta", "descuento",
    "laptop", "portatil", "notebook", "computadora",
    "smartphone", "teléfono", "móvil", "celular",
    "tableta", "tablet",
    "cámara", "DSLR", "videocámara", "fotografía",
    "auriculares", "audífonos", "cascos", "sonido",
    "monitor", "pantalla", "display", "visualización",
    "teclado", "raton", "ratón", "mouse", "periférico",
    "impresora", "printer", "escáner", "multifuncional",
    "router", "red", "Wi-Fi", "conexión",
    "altavoces", "parlantes", "audio", "sonido",
    "disco duro", "almacenamiento", "externo", "memoria",
    "tarjeta gráfica", "GPU", "componente", "juegos",
    "proyector", "proyección", "cine en casa", "presentación",
    "batería externa", "cargador portátil", "energía móvil", "power bank",
    "smartwatch", "reloj inteligente", "wearable", "actividad física",
    "cámara de seguridad", "vigilancia", "hogar", "protección",
    "Gaming", "jugadores", "videojuegos", "entretenimiento",
    "Apple", "Samsung", "Acer", "HP", "Sony", "Logitech", "Canon", "LG",
    "Bose", "Epson", "Anker", "Corsair", "ASUS", "WD", "NVIDIA", "Garmin", "Arlo"
    // Puedes agregar más marcas, productos y categorías según sea necesario
);


// Convertir la pregunta a minúsculas
$pregunta_minuscula = strtolower($pregunta);

// Separar la pregunta en palabras individuales
$palabras_en_pregunta = preg_split("/[\s,]+/", $pregunta_minuscula);

// Variables para rastrear información del producto y el rango de precios
$producto = null;
$precio_maximo = null;

// Procesar la pregunta
foreach ($palabras_en_pregunta as $palabra) {
    if (in_array($palabra, $palabras_clave)) {
        // Si la palabra clave es encontrada, establecer el producto
        $producto = $palabra;
    } elseif (is_numeric($palabra) && $producto) {
        // Si la palabra es numérica y hay un producto identificado, establecer el precio máximo
        $precio_maximo = $palabra;
        break; // No es necesario continuar procesando palabras después de encontrar el precio
    }
}

// Realizar la consulta basada en el producto y el rango de precios
if ($producto) {
    $sql = "SELECT * FROM producto WHERE 
            LOWER(nombre) LIKE '%$producto%' OR 
            UPPER(nombre) LIKE '%$producto%' OR
            nombre LIKE '%$producto%' OR
            LOWER(descripcion) LIKE '%$producto%' OR 
            UPPER(descripcion) LIKE '%$producto%' OR 
            descripcion LIKE '%$producto%'";

    // Agregar la condición de precio máximo si se especifica
    if ($precio_maximo) {
        $sql .= " AND precio <= $precio_maximo";
    }

    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<div class='row'>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-3'>"; // Use col-md-3 to have 4 columns in a row for medium-sized screens
            echo "<div class='card' style='width: 18rem;'>";
            echo "<a href='pagina_producto.php?id=" . $row['id'] . "'>";
            echo "<img src='" . $row['imagen'] . "' class='card-img-top img-hover' alt='" . $row['nombre'] . "' style='width: 200px; height: 200px; object-fit: cover;'>";
            echo "</a>";
            echo "<div class='card-body'>";
            echo "<p class='card-text'><strong>Nombre:</strong> " . $row['nombre'] . "</p>";
            echo "<p class='card-text'><strong>Precio:</strong> $" . number_format($row['precio'], 2) . " MXN</p>";
            echo "<p class='card-text'><strong>Disponibles:</strong> " . number_format($row['disponibles']) . "</p>";
            echo "</div></div></div>";
        }
    
        echo "</div>"; // Close the row
        echo "</div>"; // Close the container
    } else {
        // No se encontraron resultados
        echo "Lo siento, no se encontraron productos que coincidan con tu búsqueda.";
    } 
    
} else {
    // Respuesta para preguntas sin palabras clave
    echo "Lo siento, no puedo entender tu pregunta. ¿Puedes reformularla?";
}



$conexion->close();
?>
