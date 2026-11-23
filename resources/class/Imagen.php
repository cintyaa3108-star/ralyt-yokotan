<?php
/** Utilidades de imágenes (requiere la extensión GD de PHP, que XAMPP trae activada). */
class Imagen
{
    /**
     * Recorta la imagen al centro en cuadrado y la ajusta a $lado x $lado px.
     * Así todas las fotos de perfil tienen la misma medida y se ven bien en círculo.
     * Devuelve la ruta del archivo creado (con extensión .jpg o .png).
     */
    public static function cuadrada(string $origen, string $destinoSinExt, int $lado = 300): string {
        if (!function_exists('imagecreatetruecolor')) {
            throw new RuntimeException('El servidor no tiene activada la extensión GD de PHP.');
        }
        $info = @getimagesize($origen);
        if (!$info) throw new RuntimeException('El archivo no es una imagen válida.');

        switch ($info[2]) {
            case IMAGETYPE_JPEG: $src = @imagecreatefromjpeg($origen); $ext = 'jpg'; break;
            case IMAGETYPE_PNG:  $src = @imagecreatefrompng($origen);  $ext = 'png'; break;
            case IMAGETYPE_WEBP:
                if (!function_exists('imagecreatefromwebp')) throw new RuntimeException('Este servidor no puede leer imágenes WEBP. Usa JPG o PNG.');
                $src = @imagecreatefromwebp($origen); $ext = 'png'; break;
            default: throw new RuntimeException('Sube una imagen JPG, PNG o WEBP.');
        }
        if (!$src) throw new RuntimeException('No se pudo leer la imagen.');

        // Fotos de celular: respeta la orientación guardada en la imagen (EXIF)
        if ($info[2] === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $exif  = @exif_read_data($origen);
            $grados = [3 => 180, 6 => -90, 8 => 90][$exif['Orientation'] ?? 1] ?? 0;
            if ($grados && ($girada = imagerotate($src, $grados, 0))) { imagedestroy($src); $src = $girada; }
        }

        $w = imagesx($src); $h = imagesy($src);
        $corte = min($w, $h);                       // cuadrado más grande que cabe en la imagen
        $x = intdiv($w - $corte, 2); $y = intdiv($h - $corte, 2);

        $dst = imagecreatetruecolor($lado, $lado);
        if ($ext === 'png') {                       // conserva la transparencia
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagefill($dst, 0, 0, imagecolorallocatealpha($dst, 0, 0, 0, 127));
        }
        imagecopyresampled($dst, $src, 0, 0, $x, $y, $lado, $lado, $corte, $corte);

        $archivo = $destinoSinExt . '.' . $ext;
        $ok = $ext === 'jpg' ? imagejpeg($dst, $archivo, 88) : imagepng($dst, $archivo, 6);
        imagedestroy($src); imagedestroy($dst);
        if (!$ok) throw new RuntimeException('No se pudo guardar la imagen en el servidor.');
        return $archivo;
    }
}