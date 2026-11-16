/*
 Navicat Premium Data Transfer

 Source Server         : MARIADB
 Source Server Type    : MariaDB
 Source Server Version : 120303 (12.3.3-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ralyt

 Target Server Type    : MariaDB
 Target Server Version : 120303 (12.3.3-MariaDB)
 File Encoding         : 65001

 Date: 16/11/2026 14:20:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for actividad
-- ----------------------------
DROP TABLE IF EXISTS `actividad`;
CREATE TABLE `actividad`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_act_usr`(`usuario_id`, `fecha`) USING BTREE,
  CONSTRAINT `fk_act_usr` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of actividad
-- ----------------------------
INSERT INTO `actividad` VALUES (1, 1, 'Nivel 1: Saludos', 20, '2026-11-16 10:19:52');
INSERT INTO `actividad` VALUES (2, 2, 'Nivel 1: Saludos', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (3, 2, 'Nivel 1: Despedidas', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (4, 2, 'Nivel 1: Pronombres', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (5, 2, 'Nivel 1: Partes del cuerpo humano', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (6, 2, 'Nivel 1: Colores', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (7, 2, 'Nivel 1: Parentesco', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (8, 2, 'Nivel 1: Animales terrestres', 20, '2026-11-16 10:25:02');
INSERT INTO `actividad` VALUES (9, 2, 'Nivel 2: Saludos', 30, '2026-11-16 10:28:28');
INSERT INTO `actividad` VALUES (10, 3, 'Lección completada: Saludos', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (11, 3, 'Lección completada: Despedidas', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (12, 3, 'Lección completada: Pronombres', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (13, 3, 'Lección completada: Partes del cuerpo humano', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (14, 3, 'Lección completada: Colores', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (15, 3, 'Lección completada: Parentesco', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (16, 3, 'Lección completada: Animales terrestres', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (17, 3, 'Lección completada: Saludos', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (18, 3, 'Lección completada: Despedidas', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (19, 3, 'Lección completada: Pronombres', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (20, 3, 'Lección completada: Partes del cuerpo humano', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (21, 3, 'Lección completada: Colores', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (22, 3, 'Lección completada: Parentesco', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (23, 3, 'Lección completada: Animales terrestres', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (24, 3, 'Lección completada: Despedidas', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (25, 3, 'Lección completada: Saludos', 20, '2026-11-16 10:31:52');
INSERT INTO `actividad` VALUES (41, 3, 'Leíste: La tortuguita y la lluvia', 20, '2026-11-16 13:54:19');

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `padre_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_slug`(`slug`) USING BTREE,
  INDEX `fk_cat_padre`(`padre_id`) USING BTREE,
  CONSTRAINT `fk_cat_padre` FOREIGN KEY (`padre_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES (1, NULL, 'saludos', 'Saludos', 1);
INSERT INTO `categorias` VALUES (2, NULL, 'despedidas', 'Despedidas', 2);
INSERT INTO `categorias` VALUES (3, NULL, 'pronombres', 'Pronombres', 3);
INSERT INTO `categorias` VALUES (4, NULL, 'posesivos', 'Posesivos', 4);
INSERT INTO `categorias` VALUES (5, NULL, 'cuerpo', 'Partes del cuerpo humano', 5);
INSERT INTO `categorias` VALUES (6, NULL, 'numeros', 'Números', 6);
INSERT INTO `categorias` VALUES (7, NULL, 'colores', 'Colores', 10);
INSERT INTO `categorias` VALUES (8, NULL, 'animales', 'Animales', 11);
INSERT INTO `categorias` VALUES (9, NULL, 'parentesco', 'Parentesco', 16);
INSERT INTO `categorias` VALUES (10, NULL, 'objetos', 'Objetos', 17);
INSERT INTO `categorias` VALUES (11, NULL, 'plantas', 'Plantas medicinales', 18);
INSERT INTO `categorias` VALUES (12, NULL, 'comida', 'Comida', 19);
INSERT INTO `categorias` VALUES (13, 6, 'numeros-raiz', 'Raíz numeral', 7);
INSERT INTO `categorias` VALUES (14, 6, 'numeros-objetos', 'Clasificador de objetos o cosas', 8);
INSERT INTO `categorias` VALUES (15, 6, 'numeros-seres', 'Clasificador de personas y animales', 9);
INSERT INTO `categorias` VALUES (16, 8, 'animales-terrestres', 'Terrestres', 12);
INSERT INTO `categorias` VALUES (17, 8, 'animales-aves', 'Aves', 13);
INSERT INTO `categorias` VALUES (18, 8, 'animales-insectos', 'Insectos', 14);
INSERT INTO `categorias` VALUES (19, 8, 'animales-acuaticos', 'Acuáticos', 15);

-- ----------------------------
-- Table structure for cuento_palabras
-- ----------------------------
DROP TABLE IF EXISTS `cuento_palabras`;
CREATE TABLE `cuento_palabras`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cuento_id` int(10) UNSIGNED NOT NULL,
  `palabra` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `significado` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_cp`(`cuento_id`, `palabra`) USING BTREE,
  CONSTRAINT `fk_cp_cuento` FOREIGN KEY (`cuento_id`) REFERENCES `cuentos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cuento_palabras
-- ----------------------------
INSERT INTO `cuento_palabras` VALUES (1, 1, 'ak', 'Tortuga');
INSERT INTO `cuento_palabras` VALUES (2, 1, 'ja’', 'Agua / Río');
INSERT INTO `cuento_palabras` VALUES (3, 1, 'k’in', 'Día / Sol');
INSERT INTO `cuento_palabras` VALUES (4, 1, 'muyal', 'Nube');
INSERT INTO `cuento_palabras` VALUES (5, 1, 'ja’al', 'Lluvia');
INSERT INTO `cuento_palabras` VALUES (6, 1, 'yotot', 'Su casa / hogar');
INSERT INTO `cuento_palabras` VALUES (7, 1, 'te’ob’', 'Árboles / Plantas');
INSERT INTO `cuento_palabras` VALUES (8, 1, 'b’ä’älob’', 'Animales');
INSERT INTO `cuento_palabras` VALUES (9, 2, 'ts’unun', 'Colibrí');
INSERT INTO `cuento_palabras` VALUES (10, 2, 'nich', 'Flor');
INSERT INTO `cuento_palabras` VALUES (11, 2, 'b’ij', 'Camino');
INSERT INTO `cuento_palabras` VALUES (12, 2, 'säk’an', 'Mañana');
INSERT INTO `cuento_palabras` VALUES (13, 2, 'ch’ijil', 'Triste');
INSERT INTO `cuento_palabras` VALUES (14, 2, 'ja’', 'Agua');
INSERT INTO `cuento_palabras` VALUES (15, 2, 'uts’ät', 'Bonita / Buena');
INSERT INTO `cuento_palabras` VALUES (16, 3, 'b’äk’', 'Semilla');
INSERT INTO `cuento_palabras` VALUES (17, 3, 'ká’b', 'Tierra / Campo');
INSERT INTO `cuento_palabras` VALUES (18, 3, 'päk’e', 'Sembrarla');
INSERT INTO `cuento_palabras` VALUES (19, 3, 'k’irtan', 'Cuidar / Proteger');
INSERT INTO `cuento_palabras` VALUES (20, 3, 'ja’', 'Agua');
INSERT INTO `cuento_palabras` VALUES (21, 3, 'k’opot', 'Hierba / Monte');
INSERT INTO `cuento_palabras` VALUES (22, 3, 'te’', 'Planta / Árbol');
INSERT INTO `cuento_palabras` VALUES (23, 4, 'kaj', 'Comunidad / Pueblo');
INSERT INTO `cuento_palabras` VALUES (24, 4, 'patanob’', 'Trabajaban');
INSERT INTO `cuento_palabras` VALUES (25, 4, 'päk’äb’', 'Cultivos / Siembra');
INSERT INTO `cuento_palabras` VALUES (26, 4, 'ixím', 'Maíz');
INSERT INTO `cuento_palabras` VALUES (27, 4, 'p’k’bila', 'Cosecha');
INSERT INTO `cuento_palabras` VALUES (28, 4, 'junul', 'Unión / Juntos');
INSERT INTO `cuento_palabras` VALUES (29, 5, 'kukay', 'Luciérnaga');
INSERT INTO `cuento_palabras` VALUES (30, 5, 'ja’', 'Río / Agua');
INSERT INTO `cuento_palabras` VALUES (31, 5, 'ak’äb’', 'Noche');
INSERT INTO `cuento_palabras` VALUES (32, 5, 'b’ij', 'Camino');
INSERT INTO `cuento_palabras` VALUES (33, 5, 'b’ä’älob’', 'Animales');
INSERT INTO `cuento_palabras` VALUES (34, 5, 'yotot', 'Su hogar / casa');
INSERT INTO `cuento_palabras` VALUES (35, 6, 'noxí na’', 'Abuela');
INSERT INTO `cuento_palabras` VALUES (36, 6, 'b’äk’ob’', 'Semillas');
INSERT INTO `cuento_palabras` VALUES (37, 6, 'chikiwit', 'Canasta');
INSERT INTO `cuento_palabras` VALUES (38, 6, 'te’', 'Planta / Árbol');
INSERT INTO `cuento_palabras` VALUES (39, 6, 'ká’b', 'Tierra / Naturaleza');
INSERT INTO `cuento_palabras` VALUES (40, 6, 'k’irtan', 'Cuidar');

-- ----------------------------
-- Table structure for cuentos
-- ----------------------------
DROP TABLE IF EXISTS `cuentos`;
CREATE TABLE `cuentos`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `texto_yokotan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `traduccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `dificultad` enum('facil','media','dificil') CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT 'facil',
  `audio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cuentos
-- ----------------------------
INSERT INTO `cuentos` VALUES (1, 'La tortuguita y la lluvia', 'Aní jump’e ts’ita’ ak ke kuxu ni ts’e’ ja’. Jump’e k’in, ni chan ti’ b’uti’ ta muyal i kaj ti yajá ja’al. Ni ts’ita’ ak u b’äk’tan lok’o ta yotot, pero u k’ajtesi ke ni ja’al k’ana’ba tuba ni te’ob’ i ni b’ä’älob’. K’an ujti yajá ja’al, lok’i i u chäni ke upete an u kuxle. Desde jini, u käni ke hasta ni k’in ch’a’al u ch’e’ tälo k’a’ u ts’äkän.', 'Había una pequeña tortuga que vivía cerca de un río. Un día, el cielo se llenó de nubes y comenzó a llover. La tortuguita tenía miedo de salir de su hogar, pero recordó que la lluvia era necesaria para las plantas y los animales. Cuando terminó de llover, salió y descubrió que todo estaba lleno de vida. Desde entonces, aprendió que incluso los días difíciles pueden traer cosas buenas.', 'facil', NULL);
INSERT INTO `cuentos` VALUES (2, 'El colibrí y la flor', 'Jump’e ts’ita’ ts’unun u ximp’atän upete k’in jump’e nich ke u ch’iye ta ti’ b’ij. Jump’e säk’an u tajä ni nich ch’ijil porque jaläx mach u ch’ämi ja’. Ni ts’unun u säk’ä ts’ita’ thoj ja’ ta yopol te’ i u ch’e’ b’ixe täkä jini. Ts’ita’ ts’ita’, ni nich u cha’ tajä u ki’ol. Desde jini k’in, u cha’túlob’ u na’tä ke u koltan u b’ä u mel ke ni kuxle mas uts’ät.', 'Un pequeño colibrí visitaba todos los días una flor que crecía junto al camino. Una mañana encontró la flor triste porque llevaba mucho tiempo sin recibir agua. El colibrí buscó pequeñas gotas entre las hojas y las llevó hasta ella. Poco a poco, la flor recuperó su alegría. Desde aquel día, ambos comprendieron que ayudarse hace que la vida sea más bonita.', 'facil', NULL);
INSERT INTO `cuentos` VALUES (3, 'La semilla mágica', 'Jump’e ixik ch’ok u tajä jump’e ts’ita’ b’äk’ mientras u xänb’a ta ká’b. U tukli u päk’e i u k’irtan upete k’in. U yäk’e ja’, u lok’san ni k’opot i u k’irtan ni ká’b. K’an numi tiempo, tojk’i jump’e uts’ät te’. Ni ixik ch’ok u na’tä ke ni ká’b k’ana’ba k’irtajel i ke kada ts’ita’ patan u koltan u k’irtan ki yotot-la.', 'Una niña encontró una pequeña semilla mientras caminaba por el campo. Decidió sembrarla y cuidarla todos los días. Le daba agua, retiraba las hierbas y protegía la tierra. Después de un tiempo, nació una hermosa planta. La niña comprendió que la tierra necesita cuidados y que cada pequeña acción puede ayudar a proteger nuestro hogar.', 'facil', NULL);
INSERT INTO `cuentos` VALUES (4, 'La buena cosecha', 'Ta jump’e ts’ita’ kaj, ni familiaob’ u patanob’ junul tuba u k’irtanob’ u päk’äb’. Kada winik an u patan: ajpäk’ob’ u päk’e ixím, otro u yäk’ob’ ja’ i otro u k’irtanob’ ni te’ob’. K’an k’oti u k’inil ni p’k’bila, upete u jats’ob’ u wäy u patanob’. U känob’ ke ni junul i ni p’ätäl u koltan u tajä nukta k’a’ob’.', 'En una pequeña comunidad, las familias trabajaban juntas para cuidar sus cultivos. Cada persona tenía una tarea: algunas sembraban, otras regaban y otras cuidaban las plantas. Cuando llegó el tiempo de la cosecha, todos compartieron los frutos de su trabajo. Aprendieron que la unión y el esfuerzo ayudan a conseguir grandes cosas.', 'facil', NULL);
INSERT INTO `cuentos` VALUES (5, 'La luciérnaga del río', 'Jump’e ts’ita’ kukay kuxu ni ts’e’ ja’. Upete ak’äb’ u säk’esan u b’ij ni b’ä’älob’ ke u säk’ob’ sutwän ta yototob’. Jump’e ak’äb’ u tajä jump’e ts’ita’ b’ä’äl ke mach u taj u b’ij. Ni kukay u tukli u pi’tan hasta ta yotot. Desde jini, u na’tä ke u jats’ k’a’ an k’a’onla u koltan mas ni otroob’.', 'Una pequeña luciérnaga vivía cerca de un río. Todas las noches iluminaba el camino de los animales que buscaban regresar a sus hogares. Una noche encontró a un pequeño animal que no podía encontrar su camino. La luciérnaga decidió acompañarlo hasta su hogar. Desde entonces, comprendió que compartir lo que tenemos puede ayudar mucho a los demás.', 'facil', NULL);
INSERT INTO `cuentos` VALUES (6, 'La abuela y las semillas', 'Jump’e noxí na’ u k’eje uts’ät ts’ita’ b’äk’ob’ ta jump’e chikiwit. Jump’e k’in, u mam u k’atb’i k’a’ tuba u k’eje. Ni noxí na’ u ts’äb’i ke kada b’äk’ u ch’e’ sujtän ta jump’e ts’iji te’ i ke k’ana’ba u k’irtan k’a’ u yäk’onla ni ká’b. Junul u päk’ob’ b’äk’ob’ i u yälob’ u segui u k’irtanob’ ni ká’b. Ni ixik ch’ok u käni ke u na’tan ni noxí winikob’ jump’e nukta k’a’ ke k’ana’ba ki k’eje-la.', 'Una abuela guardaba cuidadosamente pequeñas semillas en una canasta. Un día, su nieta le preguntó por qué las conservaba. La abuela le explicó que cada semilla podía convertirse en una nueva planta y que era importante cuidar lo que la naturaleza nos ofrece. Juntas sembraron algunas semillas y prometieron seguir cuidando la tierra. La niña aprendió que los conocimientos de las personas mayores son un tesoro que debemos conservar.', 'facil', NULL);

-- ----------------------------
-- Table structure for cuentos_leidos
-- ----------------------------
DROP TABLE IF EXISTS `cuentos_leidos`;
CREATE TABLE `cuentos_leidos`  (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `cuento_id` int(10) UNSIGNED NOT NULL,
  `leido_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`usuario_id`, `cuento_id`) USING BTREE,
  INDEX `fk_cl_cue`(`cuento_id`) USING BTREE,
  CONSTRAINT `fk_cl_cue` FOREIGN KEY (`cuento_id`) REFERENCES `cuentos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_cl_usr` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cuentos_leidos
-- ----------------------------
INSERT INTO `cuentos_leidos` VALUES (3, 1, '2026-11-16 13:54:19');

-- ----------------------------
-- Table structure for lecciones
-- ----------------------------
DROP TABLE IF EXISTS `lecciones`;
CREATE TABLE `lecciones`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nivel_id` tinyint(3) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_leccion`(`nivel_id`, `categoria_id`) USING BTREE,
  INDEX `fk_lec_cat`(`categoria_id`) USING BTREE,
  CONSTRAINT `fk_lec_cat` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_lec_nivel` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lecciones
-- ----------------------------
INSERT INTO `lecciones` VALUES (1, 1, 1, 'Saludos', 1);
INSERT INTO `lecciones` VALUES (2, 1, 2, 'Despedidas', 2);
INSERT INTO `lecciones` VALUES (3, 1, 3, 'Pronombres', 3);
INSERT INTO `lecciones` VALUES (4, 1, 5, 'Partes del cuerpo humano', 5);
INSERT INTO `lecciones` VALUES (5, 1, 7, 'Colores', 10);
INSERT INTO `lecciones` VALUES (6, 1, 9, 'Parentesco', 16);
INSERT INTO `lecciones` VALUES (7, 1, 16, 'Animales terrestres', 12);
INSERT INTO `lecciones` VALUES (8, 2, 1, 'Saludos', 1);
INSERT INTO `lecciones` VALUES (9, 2, 2, 'Despedidas', 2);
INSERT INTO `lecciones` VALUES (10, 2, 3, 'Pronombres', 3);
INSERT INTO `lecciones` VALUES (11, 2, 5, 'Partes del cuerpo humano', 5);
INSERT INTO `lecciones` VALUES (12, 2, 7, 'Colores', 10);
INSERT INTO `lecciones` VALUES (13, 2, 9, 'Parentesco', 16);
INSERT INTO `lecciones` VALUES (14, 2, 16, 'Animales terrestres', 12);
INSERT INTO `lecciones` VALUES (15, 3, 2, 'Despedidas', 2);
INSERT INTO `lecciones` VALUES (16, 3, 1, 'Saludos', 1);

-- ----------------------------
-- Table structure for letras
-- ----------------------------
DROP TABLE IF EXISTS `letras`;
CREATE TABLE `letras`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `letra` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `tipo` enum('vocal','vocal_quebrada','consonante') CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `ejemplo_yokotan` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `ejemplo_espanol` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  `audio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_letra`(`letra`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of letras
-- ----------------------------
INSERT INTO `letras` VALUES (1, 'a', 'vocal', 'alás', 'Juguete', NULL, 1);
INSERT INTO `letras` VALUES (2, 'b', 'consonante', NULL, NULL, NULL, 2);
INSERT INTO `letras` VALUES (3, 'ch', 'consonante', NULL, NULL, NULL, 3);
INSERT INTO `letras` VALUES (4, 'd', 'consonante', NULL, NULL, NULL, 4);
INSERT INTO `letras` VALUES (5, 'e', 'vocal', 'ek\'', 'Estrella', NULL, 5);
INSERT INTO `letras` VALUES (6, 'i', 'vocal', 'ich', 'Chile', NULL, 6);
INSERT INTO `letras` VALUES (7, 'j', 'consonante', NULL, NULL, NULL, 7);
INSERT INTO `letras` VALUES (8, 'k', 'consonante', NULL, NULL, NULL, 8);
INSERT INTO `letras` VALUES (9, 'l', 'consonante', NULL, NULL, NULL, 9);
INSERT INTO `letras` VALUES (10, 'm', 'consonante', NULL, NULL, NULL, 10);
INSERT INTO `letras` VALUES (11, 'n', 'consonante', NULL, NULL, NULL, 11);
INSERT INTO `letras` VALUES (12, 'o', 'vocal', 'oj', 'Caña', NULL, 12);
INSERT INTO `letras` VALUES (13, 'p', 'consonante', NULL, NULL, NULL, 13);
INSERT INTO `letras` VALUES (14, 'r', 'consonante', NULL, NULL, NULL, 14);
INSERT INTO `letras` VALUES (15, 's', 'consonante', NULL, NULL, NULL, 15);
INSERT INTO `letras` VALUES (16, 't', 'consonante', NULL, NULL, NULL, 16);
INSERT INTO `letras` VALUES (17, 'u', 'vocal', 'uch', 'Zorro', NULL, 17);
INSERT INTO `letras` VALUES (18, 'ts', 'consonante', NULL, NULL, NULL, 18);
INSERT INTO `letras` VALUES (19, 'w', 'consonante', NULL, NULL, NULL, 19);
INSERT INTO `letras` VALUES (20, 'x', 'consonante', NULL, NULL, NULL, 20);
INSERT INTO `letras` VALUES (21, 'y', 'consonante', NULL, NULL, NULL, 21);
INSERT INTO `letras` VALUES (22, 'ɨ', 'vocal', 'ɨlɨk\'i', 'Animales', NULL, 22);
INSERT INTO `letras` VALUES (23, 'a\'a', 'vocal_quebrada', NULL, NULL, NULL, 101);
INSERT INTO `letras` VALUES (24, 'e\'e', 'vocal_quebrada', NULL, NULL, NULL, 102);
INSERT INTO `letras` VALUES (25, 'i\'i', 'vocal_quebrada', NULL, NULL, NULL, 103);
INSERT INTO `letras` VALUES (26, 'o\'o', 'vocal_quebrada', NULL, NULL, NULL, 104);
INSERT INTO `letras` VALUES (27, 'u\'u', 'vocal_quebrada', NULL, NULL, NULL, 105);
INSERT INTO `letras` VALUES (28, 'ɨ\'ɨ', 'vocal_quebrada', NULL, NULL, NULL, 106);

-- ----------------------------
-- Table structure for niveles
-- ----------------------------
DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles`  (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `tipo` enum('escucha','memorama','escritura','lectura') CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of niveles
-- ----------------------------
INSERT INTO `niveles` VALUES (1, 'Escucha y repite', 'escucha', 'Escuchar y repetir las palabras');
INSERT INTO `niveles` VALUES (2, 'Memorama', 'memorama', 'Identificar palabras uniendo parejas');
INSERT INTO `niveles` VALUES (3, 'Escritura', 'escritura', 'Crear frases ordenando palabras a partir de audios');
INSERT INTO `niveles` VALUES (4, 'Lectura', 'lectura', 'Leer cuentos y leyendas con traducción al tocar cada palabra');

-- ----------------------------
-- Table structure for palabras
-- ----------------------------
DROP TABLE IF EXISTS `palabras`;
CREATE TABLE `palabras`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `yokotan` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `espanol` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `tipo` enum('palabra','frase') CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT 'palabra',
  `audio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  `nota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_palabra`(`categoria_id`, `yokotan`) USING BTREE,
  INDEX `idx_espanol`(`espanol`) USING BTREE,
  CONSTRAINT `fk_pal_cat` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 221 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of palabras
-- ----------------------------
INSERT INTO `palabras` VALUES (1, 1, 'Uts a julet-la', 'Bienvenidos', 'frase', NULL, 'bienvenidos.png', NULL, 1);
INSERT INTO `palabras` VALUES (2, 1, 'Uts k\'in', 'Buenos días', 'frase', NULL, 'buenosdias.png', NULL, 2);
INSERT INTO `palabras` VALUES (3, 1, 'Uts k\'in aj ye\'jun', 'Buenos días maestro', 'frase', NULL, 'buenosdiasmaestro.png', NULL, 3);
INSERT INTO `palabras` VALUES (4, 1, 'Uts k\'in aj kɨnjun', 'Buenos días alumnos', 'frase', NULL, 'buenosdiasalumnos.png', NULL, 4);
INSERT INTO `palabras` VALUES (5, 1, 'Uts tɨnxin k\'in', 'Buenas tardes', 'frase', NULL, 'buenastardes.png', NULL, 5);
INSERT INTO `palabras` VALUES (6, 1, 'Uts ak\'ɨb', 'Buenas noches', 'frase', NULL, 'buenasnoches.png', NULL, 6);
INSERT INTO `palabras` VALUES (7, 2, 'Dali kubila', 'Nos vemos', 'frase', NULL, 'nosvemos.png', NULL, 1);
INSERT INTO `palabras` VALUES (8, 2, 'Ik\'ɨto', 'Hasta mañana', 'frase', NULL, 'hastamanana.png', NULL, 2);
INSERT INTO `palabras` VALUES (9, 2, 'Dali kɨ chine kɨbala', 'Nos vemos después', 'frase', NULL, 'nosvemosdespues.png', NULL, 3);
INSERT INTO `palabras` VALUES (10, 2, 'Uts a bixe\'', 'Que te vaya bien', 'frase', NULL, 'quetevayabien.png', NULL, 4);
INSERT INTO `palabras` VALUES (11, 2, 'Kɨrintanaba', 'Cuídate', 'frase', NULL, 'cuidate.png', NULL, 5);
INSERT INTO `palabras` VALUES (12, 2, 'T\'o kɨ papla a bixe', 'Ve con Dios', 'frase', NULL, 'vecondios.png', NULL, 6);
INSERT INTO `palabras` VALUES (13, 2, 'K\'adios', 'Gracias', 'frase', NULL, 'gracias.png', NULL, 7);
INSERT INTO `palabras` VALUES (14, 2, 'Dalito', 'Nos vemos más tarde', 'frase', NULL, 'nosvemosmastarde.png', NULL, 8);
INSERT INTO `palabras` VALUES (15, 3, 'kɨne', 'Yo', 'palabra', NULL, 'yo.png', NULL, 1);
INSERT INTO `palabras` VALUES (16, 3, 'Ane', 'Tú', 'palabra', NULL, 'tu.png', NULL, 2);
INSERT INTO `palabras` VALUES (17, 3, 'Une', 'Él/Ella', 'palabra', NULL, 'elella.png', NULL, 3);
INSERT INTO `palabras` VALUES (18, 3, 'Kɨnela', 'Nosotros', 'palabra', NULL, 'nosotros.png', NULL, 4);
INSERT INTO `palabras` VALUES (19, 3, 'Anela', 'Ustedes', 'palabra', NULL, 'ustedes.png', NULL, 5);
INSERT INTO `palabras` VALUES (20, 3, 'Unejob', 'Ellos/Ellas', 'palabra', NULL, 'ellosellas.png', NULL, 6);
INSERT INTO `palabras` VALUES (21, 4, 'Kɨ', 'Mío', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (22, 4, 'a', 'Tuyo', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (23, 4, 'u', 'Suyo', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (24, 5, 'Pam', 'Cabeza', 'palabra', NULL, 'cabeza.png', NULL, 1);
INSERT INTO `palabras` VALUES (25, 5, 'Ti\' pám', 'Frente', 'palabra', NULL, 'frente.png', NULL, 2);
INSERT INTO `palabras` VALUES (26, 5, 'Tsuk', 'Cabello', 'palabra', NULL, 'cabello.png', NULL, 3);
INSERT INTO `palabras` VALUES (27, 5, 'Tsutsjút', 'Ceja', 'palabra', NULL, 'ceja.png', NULL, 4);
INSERT INTO `palabras` VALUES (28, 5, 'Jut', 'Ojo', 'palabra', NULL, 'ojo.png', NULL, 5);
INSERT INTO `palabras` VALUES (29, 5, 'Ni\'', 'Nariz', 'palabra', NULL, 'nariz.png', NULL, 6);
INSERT INTO `palabras` VALUES (30, 5, 'Ti\'', 'Boca', 'palabra', NULL, 'boca.png', NULL, 7);
INSERT INTO `palabras` VALUES (31, 5, 'Pechkem', 'Hombro', 'palabra', NULL, 'hombro.png', NULL, 8);
INSERT INTO `palabras` VALUES (32, 5, 'Chu\'', 'Busto', 'palabra', NULL, 'busto.png', NULL, 9);
INSERT INTO `palabras` VALUES (33, 5, 'Miku', 'Axila', 'palabra', NULL, 'axila.png', NULL, 10);
INSERT INTO `palabras` VALUES (34, 5, 'Luk\'ub', 'Cuello', 'palabra', NULL, 'cuello.png', NULL, 11);
INSERT INTO `palabras` VALUES (35, 5, 'Muk', 'Ombligo', 'palabra', NULL, 'ombligo.png', NULL, 12);
INSERT INTO `palabras` VALUES (36, 5, 'Nɨk\'', 'Estómago', 'palabra', NULL, 'estomago.png', NULL, 13);
INSERT INTO `palabras` VALUES (37, 5, 'Chikin', 'Oreja', 'palabra', NULL, 'oreja.png', NULL, 14);
INSERT INTO `palabras` VALUES (38, 5, 'Choj', 'Mejilla', 'palabra', NULL, 'mejilla.png', NULL, 15);
INSERT INTO `palabras` VALUES (39, 5, 'Ok', 'Pie', 'palabra', NULL, 'pie.png', NULL, 16);
INSERT INTO `palabras` VALUES (40, 5, 'Wok', 'Pierna', 'palabra', NULL, 'pierna.png', NULL, 17);
INSERT INTO `palabras` VALUES (41, 5, 'Pix', 'Rodilla', 'palabra', NULL, 'rodilla.png', NULL, 18);
INSERT INTO `palabras` VALUES (42, 5, 'Ni\'ok', 'Dedos del pie', 'palabra', NULL, 'dedosdelpie.png', NULL, 19);
INSERT INTO `palabras` VALUES (43, 5, 'Tun ok', 'Talón', 'palabra', NULL, 'talon.png', NULL, 20);
INSERT INTO `palabras` VALUES (44, 5, 'Ta\'ok', 'Pantorilla', 'palabra', NULL, NULL, NULL, 21);
INSERT INTO `palabras` VALUES (45, 5, 'Ni\' k\'ɨb', 'Dedos de las manos', 'palabra', NULL, 'dedodelasmanos.png', NULL, 22);
INSERT INTO `palabras` VALUES (46, 5, 'Ich\'ɨk', 'Uñas', 'palabra', NULL, 'uñas.png', NULL, 23);
INSERT INTO `palabras` VALUES (47, 13, 'Un', 'Uno', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (48, 13, 'Cha\'', 'Dos', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (49, 13, 'Ux', 'Tres', 'palabra', NULL, 'ganado.png', NULL, 3);
INSERT INTO `palabras` VALUES (50, 13, 'Chɨn', 'Cuatro', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (51, 13, 'Jon', 'Cinco', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (52, 14, 'Unp\'e', 'Uno', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (53, 14, 'Cha\'p\'e', 'Dos', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (54, 14, 'Uxp\'e', 'Tres', 'palabra', NULL, 'ganado.png', NULL, 3);
INSERT INTO `palabras` VALUES (55, 14, 'Chɨnp\'e', 'Cuatro', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (56, 14, 'Jonp\'e', 'Cinco', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (57, 15, 'Untú Yiník', 'Un hombre', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (58, 15, 'Chatú Ixík', 'Una mujer', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (59, 15, 'Uxtú Yichu\'', 'Tres perros', 'palabra', NULL, 'perro.png', NULL, 3);
INSERT INTO `palabras` VALUES (60, 15, 'Chɨntú Mut', 'Cuatro pájaros', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (61, 15, 'Jontú Juts\'', 'Cinco lagartos', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (62, 7, 'Sɨk', 'Blanco', 'palabra', NULL, 'blanco.png', NULL, 1);
INSERT INTO `palabras` VALUES (63, 7, 'Chɨk', 'Rojo', 'palabra', NULL, 'rojo.png', NULL, 2);
INSERT INTO `palabras` VALUES (64, 7, 'Ik\'', 'Negro', 'palabra', NULL, 'negro.png', NULL, 3);
INSERT INTO `palabras` VALUES (65, 7, 'Yɨx', 'Verde', 'palabra', NULL, 'verde.png', 'En el documento estaba escrito al revés (español: yokot\'an); se corrigió el orden', 4);
INSERT INTO `palabras` VALUES (66, 7, 'K\'ɨnpakan', 'Amarillo', 'palabra', NULL, 'amarillo.png', NULL, 5);
INSERT INTO `palabras` VALUES (67, 7, 'K\'ɨntajan', 'Naranja', 'palabra', NULL, 'naranja.png', NULL, 6);
INSERT INTO `palabras` VALUES (68, 7, 'Yɨxulan', 'Azul', 'palabra', NULL, 'azul.png', NULL, 7);
INSERT INTO `palabras` VALUES (69, 7, 'Ik\'buk\'an', 'Morado', 'palabra', NULL, 'morado.png', NULL, 8);
INSERT INTO `palabras` VALUES (70, 7, 'Ik\' bujan', 'Café', 'palabra', NULL, 'cafe.png', NULL, 9);
INSERT INTO `palabras` VALUES (71, 7, 'Poschɨk', 'Rosa', 'palabra', NULL, 'rosa.png', NULL, 10);
INSERT INTO `palabras` VALUES (72, 7, 'Tsɨtsɨ ik\'', 'Gris', 'palabra', NULL, 'gris.png', NULL, 11);
INSERT INTO `palabras` VALUES (73, 16, 'Yichu\'', 'Perro', 'palabra', NULL, 'perro.png', NULL, 1);
INSERT INTO `palabras` VALUES (74, 16, 'Much', 'Sapo', 'palabra', NULL, 'sapo.png', NULL, 2);
INSERT INTO `palabras` VALUES (75, 16, 'Mis', 'Gato', 'palabra', NULL, 'gato.png', NULL, 3);
INSERT INTO `palabras` VALUES (76, 16, 'Chimay', 'Venado', 'palabra', NULL, 'venado.png', NULL, 4);
INSERT INTO `palabras` VALUES (77, 16, 'Tsimín', 'Caballo', 'palabra', NULL, 'caballo.png', NULL, 5);
INSERT INTO `palabras` VALUES (78, 16, 'Balúm', 'Tigre', 'palabra', NULL, 'tigre.png', NULL, 6);
INSERT INTO `palabras` VALUES (79, 16, 'Pum', 'Mono', 'palabra', NULL, 'mono.png', NULL, 7);
INSERT INTO `palabras` VALUES (80, 16, 'Piyo\'', 'Pollo', 'palabra', NULL, 'pollo.png', NULL, 8);
INSERT INTO `palabras` VALUES (81, 16, 'Patu\'', 'Pato', 'palabra', NULL, 'pato.png', NULL, 9);
INSERT INTO `palabras` VALUES (82, 16, 'Mulu\'', 'Pavo', 'palabra', NULL, 'pavo.png', NULL, 10);
INSERT INTO `palabras` VALUES (83, 16, 'Tsuk', 'Rata', 'palabra', NULL, 'rata.png', NULL, 11);
INSERT INTO `palabras` VALUES (84, 16, 'Chitam', 'Puerco', 'palabra', NULL, 'puerco.png', NULL, 12);
INSERT INTO `palabras` VALUES (85, 16, 'Te\'le yichu\'', 'Lobo', 'palabra', NULL, 'lobo.png', NULL, 13);
INSERT INTO `palabras` VALUES (86, 16, 'Te\'le chitam', 'Jabalí', 'palabra', NULL, 'jabali.png', NULL, 14);
INSERT INTO `palabras` VALUES (87, 16, 'Tensús', 'Borrego', 'palabra', NULL, 'oveja.png', NULL, 15);
INSERT INTO `palabras` VALUES (88, 16, 'Chiku', 'Mapache', 'palabra', NULL, 'mapache.png', NULL, 16);
INSERT INTO `palabras` VALUES (89, 16, 'Ibach', 'Armadillo', 'palabra', NULL, 'armadillo.png', NULL, 17);
INSERT INTO `palabras` VALUES (90, 16, 'T\'ul', 'Conejo', 'palabra', NULL, 'conejo.png', NULL, 18);
INSERT INTO `palabras` VALUES (91, 16, 'Chuch', 'Ardilla', 'palabra', NULL, 'ardilla.png', NULL, 19);
INSERT INTO `palabras` VALUES (92, 16, 'Tso\'', 'Pavo macho', 'palabra', NULL, 'pavomacho.png', NULL, 20);
INSERT INTO `palabras` VALUES (93, 16, 'Chan', 'Serpiente', 'palabra', NULL, 'serpiente.png', NULL, 21);
INSERT INTO `palabras` VALUES (94, 16, 'Yokochan', 'Nauyaka', 'palabra', NULL, 'nauyaka.png', NULL, 22);
INSERT INTO `palabras` VALUES (95, 16, 'Mokoch', 'Boa', 'palabra', NULL, 'boa.png', NULL, 23);
INSERT INTO `palabras` VALUES (96, 16, 'Bek\'et', 'Ganado', 'palabra', NULL, 'ganado.png', NULL, 24);
INSERT INTO `palabras` VALUES (97, 16, 'Uch', 'Zorro', 'palabra', NULL, 'zorro.png', NULL, 25);
INSERT INTO `palabras` VALUES (98, 16, 'Juj', 'Iguana', 'palabra', NULL, 'iguana.png', NULL, 26);
INSERT INTO `palabras` VALUES (99, 16, 'Choj', 'Garrobo', 'palabra', NULL, 'garrobo.png', NULL, 27);
INSERT INTO `palabras` VALUES (100, 17, 'Chech', 'Perico', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (101, 17, 'Chupitsaja', 'Colibrí', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (102, 17, 'T\'o\'', 'Garza', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (103, 17, 'Kox', 'Tecolote', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (104, 17, 'Ju\'', 'Lechuza', 'palabra', NULL, NULL, 'En el documento estaba escrito al revés (español: yokot\'an); se corrigió el orden', 5);
INSERT INTO `palabras` VALUES (105, 17, 'Xoch\'', 'Búho', 'palabra', NULL, NULL, 'En el documento estaba escrito al revés (español: yokot\'an); se corrigió el orden', 6);
INSERT INTO `palabras` VALUES (106, 17, 'Mixix', 'Pijije', 'palabra', NULL, NULL, NULL, 7);
INSERT INTO `palabras` VALUES (107, 17, 'K\'ɨyi\'', 'Sanate', 'palabra', NULL, NULL, NULL, 8);
INSERT INTO `palabras` VALUES (108, 17, 'Babak', 'Pájaro vaquero', 'palabra', NULL, NULL, NULL, 9);
INSERT INTO `palabras` VALUES (109, 17, 'Chujob', 'Pájaro carpintero', 'palabra', NULL, NULL, NULL, 10);
INSERT INTO `palabras` VALUES (110, 17, 'Tsiya\'', 'Pájaro chilero', 'palabra', NULL, NULL, NULL, 11);
INSERT INTO `palabras` VALUES (111, 18, 'T\'urux', 'Chicharra', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (112, 18, 'Pempem', 'Mariposa', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (113, 18, 'Chinay', 'Grillo', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (114, 18, 'Sinaj', 'Alacrán', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (115, 18, 'Mox', 'Escarabajo', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (116, 18, 'Yerba', 'Tarántula', 'palabra', NULL, NULL, NULL, 6);
INSERT INTO `palabras` VALUES (117, 18, 'Toy', 'Araña', 'palabra', NULL, 'sapo.png', NULL, 7);
INSERT INTO `palabras` VALUES (118, 18, 'Uch\'a', 'Mosquito', 'palabra', NULL, NULL, NULL, 8);
INSERT INTO `palabras` VALUES (119, 18, 'Jajɨn', 'Mosca grande', 'palabra', NULL, NULL, NULL, 9);
INSERT INTO `palabras` VALUES (120, 18, 'Kukarach', 'Cucaracha', 'palabra', NULL, NULL, NULL, 10);
INSERT INTO `palabras` VALUES (121, 18, 'Xinich\'', 'Hormiga', 'palabra', NULL, NULL, NULL, 11);
INSERT INTO `palabras` VALUES (122, 18, 'Nok\'', 'Gusano', 'palabra', NULL, NULL, NULL, 12);
INSERT INTO `palabras` VALUES (123, 18, 'Moso\'', 'Lombriz de tierra', 'palabra', NULL, NULL, NULL, 13);
INSERT INTO `palabras` VALUES (124, 18, 'K\'ana\'', 'Avispa', 'palabra', NULL, NULL, NULL, 14);
INSERT INTO `palabras` VALUES (125, 18, 'Ch\'ikɨb', 'Salamandra', 'palabra', NULL, NULL, NULL, 15);
INSERT INTO `palabras` VALUES (126, 18, 'Uch\'', 'Piojo', 'palabra', NULL, NULL, NULL, 16);
INSERT INTO `palabras` VALUES (127, 18, 'Yechi\'', 'Comején', 'palabra', NULL, NULL, NULL, 17);
INSERT INTO `palabras` VALUES (128, 18, 'K\'oj', 'Tábano', 'palabra', NULL, NULL, NULL, 18);
INSERT INTO `palabras` VALUES (129, 18, 'Ch\'ɨk', 'Pulga', 'palabra', NULL, NULL, NULL, 19);
INSERT INTO `palabras` VALUES (130, 18, 'P\'up\'u', 'Gorgojo', 'palabra', NULL, NULL, NULL, 20);
INSERT INTO `palabras` VALUES (131, 19, 'Buch', 'Pescado', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (132, 19, 'Ibam', 'Pejelagarto', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (133, 19, 'Juts\'', 'Lagarto', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (134, 19, 'Tíl', 'Manatí', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (135, 19, 'Tsits\'ɨk', 'Robalo', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (136, 19, 'Tsits\'ak', 'Hicotea', 'palabra', NULL, NULL, NULL, 6);
INSERT INTO `palabras` VALUES (137, 19, 'T\'ot\'', 'Caracol', 'palabra', NULL, NULL, NULL, 7);
INSERT INTO `palabras` VALUES (138, 19, 'Xex', 'Camarón', 'palabra', NULL, NULL, NULL, 8);
INSERT INTO `palabras` VALUES (139, 19, 'Ak', 'Tortuga', 'palabra', NULL, NULL, NULL, 9);
INSERT INTO `palabras` VALUES (140, 19, 'Juch', 'Almeja', 'palabra', NULL, NULL, NULL, 10);
INSERT INTO `palabras` VALUES (141, 19, 'Topem', 'Topen', 'palabra', NULL, NULL, NULL, 11);
INSERT INTO `palabras` VALUES (142, 19, 'Yokobuch\'', 'Casta rica', 'palabra', NULL, NULL, NULL, 12);
INSERT INTO `palabras` VALUES (143, 19, 'Pɨt\'in', 'Cangrejo', 'palabra', NULL, NULL, NULL, 13);
INSERT INTO `palabras` VALUES (144, 9, 'Na\'', 'Mamá', 'palabra', NULL, 'mama.png', NULL, 1);
INSERT INTO `palabras` VALUES (145, 9, 'Pap\'', 'Papá', 'palabra', NULL, 'papa.png', NULL, 2);
INSERT INTO `palabras` VALUES (146, 9, 'Noxí Na\'', 'Abuela', 'palabra', NULL, 'abuela.png', NULL, 3);
INSERT INTO `palabras` VALUES (147, 9, 'Noxí Pap', 'Abuelo', 'palabra', NULL, 'abuelo.png', NULL, 4);
INSERT INTO `palabras` VALUES (148, 9, 'Mam', 'Nieto', 'palabra', NULL, 'nieto.png', NULL, 5);
INSERT INTO `palabras` VALUES (149, 9, 'Tsukún', 'Tío', 'palabra', NULL, 'tio.png', NULL, 6);
INSERT INTO `palabras` VALUES (150, 9, 'Chich', 'Tía', 'palabra', NULL, 'tia.png', NULL, 7);
INSERT INTO `palabras` VALUES (151, 10, 't\'u\'b', 'Jícara', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (152, 10, 'P\'et', 'Olla', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (153, 10, 'mɨk', 'Cuchara', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (154, 10, 'Sék\'i\' ye\'é', 'Cuchillo', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (155, 10, 'Chijt\'ú\'b', 'Cernidor', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (156, 10, 'Júch\'i\' ixím', 'Molino', 'palabra', NULL, NULL, NULL, 6);
INSERT INTO `palabras` VALUES (157, 10, 'Semét', 'Comal', 'palabra', NULL, NULL, NULL, 7);
INSERT INTO `palabras` VALUES (158, 10, 'Ts\'ɨbi\'k\'ák\'', 'Cerillo', 'palabra', NULL, NULL, NULL, 8);
INSERT INTO `palabras` VALUES (159, 10, 'Mojíp\'', 'Desgranador', 'palabra', NULL, 'sapo.png', NULL, 9);
INSERT INTO `palabras` VALUES (160, 10, 'Cha\'', 'Metate', 'palabra', NULL, NULL, NULL, 10);
INSERT INTO `palabras` VALUES (161, 10, 'misíp\'', 'Escoba', 'palabra', NULL, NULL, NULL, 11);
INSERT INTO `palabras` VALUES (162, 10, 'pech', 'Abanico', 'palabra', NULL, NULL, NULL, 12);
INSERT INTO `palabras` VALUES (163, 10, 'chach', 'Canasta', 'palabra', NULL, NULL, NULL, 13);
INSERT INTO `palabras` VALUES (164, 10, 'Juch\'ijo\'óx', 'Molcajete', 'palabra', NULL, NULL, NULL, 14);
INSERT INTO `palabras` VALUES (165, 10, 'Balde', 'Cubeta', 'palabra', NULL, NULL, 'Ambas palabras parecen ser español; revisar', 15);
INSERT INTO `palabras` VALUES (166, 10, 'Ch\'ikɨ\'', 'Mandil', 'palabra', NULL, NULL, NULL, 16);
INSERT INTO `palabras` VALUES (167, 10, 'pɨyte\'', 'Tabla o mesa', 'palabra', NULL, NULL, NULL, 17);
INSERT INTO `palabras` VALUES (168, 10, 'ɨki ye\'e', 'Plato', 'palabra', NULL, NULL, NULL, 18);
INSERT INTO `palabras` VALUES (169, 11, 'Chinte\'', 'Cocoite', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (170, 11, 'wɨyerpimi', 'Dormilona', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (171, 11, 'tujen a uch\'', 'Hoja de zorrillo', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (172, 11, 'sauko', 'Sauco', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (173, 11, 'tsuk ixím', 'Pelo de maíz', 'palabra', NULL, 'cabello.png', NULL, 5);
INSERT INTO `palabras` VALUES (174, 11, 'Lante\'', 'Llanté', 'palabra', NULL, NULL, NULL, 6);
INSERT INTO `palabras` VALUES (175, 11, 'Yopte\' patá', 'Hoja de guayaba', 'palabra', NULL, NULL, NULL, 7);
INSERT INTO `palabras` VALUES (176, 11, 'Tsampólip', 'Sampoal', 'palabra', NULL, NULL, NULL, 8);
INSERT INTO `palabras` VALUES (177, 11, 'K\'usamuch', 'Hoja de sapo', 'palabra', NULL, 'sapo.png', NULL, 9);
INSERT INTO `palabras` VALUES (178, 11, 'Tajte\' pimi', 'Hierba martín', 'palabra', NULL, NULL, NULL, 10);
INSERT INTO `palabras` VALUES (179, 11, 'Tsitsim', 'Esencia verde', 'palabra', NULL, 'verde.png', NULL, 11);
INSERT INTO `palabras` VALUES (180, 11, 'Ruda', 'Ruda', 'palabra', NULL, NULL, NULL, 12);
INSERT INTO `palabras` VALUES (181, 11, 'Albajaka', 'Albahaca', 'palabra', NULL, NULL, NULL, 13);
INSERT INTO `palabras` VALUES (182, 11, 'Pasote', 'Epazote', 'palabra', NULL, NULL, NULL, 14);
INSERT INTO `palabras` VALUES (183, 12, 'ichír-ibám', 'Pejelagarto en chirmol', 'palabra', NULL, NULL, NULL, 1);
INSERT INTO `palabras` VALUES (184, 12, 'pópo ibám', 'Pejelagarto asado', 'palabra', NULL, NULL, NULL, 2);
INSERT INTO `palabras` VALUES (185, 12, 'pópo buch\'', 'Mojarra asada', 'palabra', NULL, NULL, NULL, 3);
INSERT INTO `palabras` VALUES (186, 12, 'tsájɨ\' buch\'', 'Mojarra frita', 'palabra', NULL, NULL, NULL, 4);
INSERT INTO `palabras` VALUES (187, 12, 'pɨkto\' buch\'', 'Mojarra envuelta', 'palabra', NULL, NULL, NULL, 5);
INSERT INTO `palabras` VALUES (188, 12, 'k\'ap piyo\'', 'Caldo', 'palabra', NULL, NULL, NULL, 6);
INSERT INTO `palabras` VALUES (189, 12, 'ch\'atɨr píyo\'', 'Pollo asado', 'palabra', NULL, 'pollo.png', NULL, 7);
INSERT INTO `palabras` VALUES (190, 12, 'be\'wáj', 'Tamal', 'palabra', NULL, NULL, NULL, 8);
INSERT INTO `palabras` VALUES (191, 12, 'waj', 'Tortilla', 'palabra', NULL, NULL, NULL, 9);
INSERT INTO `palabras` VALUES (192, 12, 'sɨkbuk\'á', 'Pozol blanco', 'palabra', NULL, 'blanco.png', NULL, 10);
INSERT INTO `palabras` VALUES (193, 12, 'jách\'im buk\'a', 'Pozol con cacao', 'palabra', NULL, NULL, NULL, 11);
INSERT INTO `palabras` VALUES (194, 12, 'Íchir p\'ulbek\'ét', 'Chirmol de mondongo', 'palabra', NULL, NULL, NULL, 12);
INSERT INTO `palabras` VALUES (195, 12, 'Béwɨr chitám', 'Tamal de cerdo', 'palabra', NULL, 'puerco.png', NULL, 13);
INSERT INTO `palabras` VALUES (196, 12, 'Be\'wɨrmúlu\'', 'Tamal de pavo', 'palabra', NULL, NULL, NULL, 14);
INSERT INTO `palabras` VALUES (197, 12, 'Be\'wɨrbuch\'', 'Tamal de mojarra', 'palabra', NULL, NULL, NULL, 15);
INSERT INTO `palabras` VALUES (198, 12, 'Be\'wɨrbek\'et', 'Tamal de res', 'palabra', NULL, 'ganado.png', NULL, 16);
INSERT INTO `palabras` VALUES (199, 12, 'Be\'wɨr-ek\'', 'Tamal de chaya', 'palabra', NULL, NULL, NULL, 17);
INSERT INTO `palabras` VALUES (200, 12, 'Be\'wɨrpíyo\'', 'Tamal de pollo', 'palabra', NULL, 'pollo.png', NULL, 18);
INSERT INTO `palabras` VALUES (201, 12, 'Be\'wɨrsits\'ak', 'Tamal de hicotea', 'palabra', NULL, NULL, NULL, 19);
INSERT INTO `palabras` VALUES (202, 12, 'Be\'wɨr-aj-júts\'', 'Tamal de lagarto', 'palabra', NULL, NULL, NULL, 20);
INSERT INTO `palabras` VALUES (203, 12, 'Xíxi\'-be\'wáj', 'Tamal de carne deshebrada', 'palabra', NULL, NULL, NULL, 21);
INSERT INTO `palabras` VALUES (204, 12, 'Be\'wɨrbu\'u', 'Tamal de frijol', 'palabra', NULL, NULL, NULL, 22);
INSERT INTO `palabras` VALUES (205, 12, 'Jayɨrwáj', 'Totoposte', 'palabra', NULL, NULL, NULL, 23);
INSERT INTO `palabras` VALUES (206, 12, 'Kop\'omwáj', 'Tortilla tostada', 'palabra', NULL, NULL, NULL, 24);
INSERT INTO `palabras` VALUES (207, 12, 'Ts\'inirwáj', 'Tortilla de yuca', 'palabra', NULL, NULL, NULL, 25);
INSERT INTO `palabras` VALUES (208, 12, 'Pimpimwáj', 'Tortilla gruesa', 'palabra', NULL, NULL, NULL, 26);
INSERT INTO `palabras` VALUES (209, 12, 'Siswáj', 'Tortilla de maíz tierno', 'palabra', NULL, NULL, NULL, 27);
INSERT INTO `palabras` VALUES (210, 12, 'Jɨ\'ɨswáj', 'Tortilla de plátano verde', 'palabra', NULL, 'verde.png', NULL, 28);
INSERT INTO `palabras` VALUES (211, 12, 'Ch\'atɨrpiyo\'', 'Pollo asado', 'palabra', NULL, 'pollo.png', NULL, 29);
INSERT INTO `palabras` VALUES (212, 12, 'Ch\'atɨrye\'libek\'et', 'Carne asada', 'palabra', NULL, NULL, NULL, 30);
INSERT INTO `palabras` VALUES (213, 12, 'Ch\'atɨr buch\'', 'Mojarra asada', 'palabra', NULL, NULL, NULL, 31);
INSERT INTO `palabras` VALUES (214, 12, 'K\'omto\'buch\'', 'Mojarra al vapor', 'palabra', NULL, NULL, NULL, 32);
INSERT INTO `palabras` VALUES (215, 12, 'Pɨkto\'buch\'', 'Mojarra envuelto en hoja', 'palabra', NULL, NULL, NULL, 33);
INSERT INTO `palabras` VALUES (216, 12, 'Ichir ye\'e de bek\'et', 'Chirmol de carne de res', 'palabra', NULL, 'ganado.png', NULL, 34);
INSERT INTO `palabras` VALUES (217, 12, 'Ichir-ibám', 'Chirmol de pejelagarto', 'palabra', NULL, NULL, NULL, 35);
INSERT INTO `palabras` VALUES (218, 12, 'Ichirbuch\'', 'Chirmol de pescado', 'palabra', NULL, NULL, NULL, 36);
INSERT INTO `palabras` VALUES (219, 12, 'Ichirpátu\'', 'Chirmol de pato', 'palabra', NULL, NULL, NULL, 37);
INSERT INTO `palabras` VALUES (220, 12, 'Ichirpiyo\'', 'Chirmol de pollo', 'palabra', NULL, 'pollo.png', NULL, 38);

-- ----------------------------
-- Table structure for progreso
-- ----------------------------
DROP TABLE IF EXISTS `progreso`;
CREATE TABLE `progreso`  (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `leccion_id` int(10) UNSIGNED NOT NULL,
  `completada` tinyint(1) NOT NULL DEFAULT 0,
  `puntos` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `completada_en` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usuario_id`, `leccion_id`) USING BTREE,
  INDEX `fk_prog_lec`(`leccion_id`) USING BTREE,
  CONSTRAINT `fk_prog_lec` FOREIGN KEY (`leccion_id`) REFERENCES `lecciones` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_prog_usr` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of progreso
-- ----------------------------
INSERT INTO `progreso` VALUES (1, 1, 1, 20, '2026-11-16 10:19:52');
INSERT INTO `progreso` VALUES (2, 1, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 2, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 3, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 4, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 5, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 6, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 7, 1, 20, '2026-11-16 10:25:02');
INSERT INTO `progreso` VALUES (2, 8, 1, 30, '2026-11-16 10:28:28');
INSERT INTO `progreso` VALUES (3, 1, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 2, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 3, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 4, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 5, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 6, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 7, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 8, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 9, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 10, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 11, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 12, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 13, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 14, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 15, 1, 20, '2026-11-16 10:31:52');
INSERT INTO `progreso` VALUES (3, 16, 1, 20, '2026-11-16 10:31:52');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `usuario` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `correo` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL,
  `puntos` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `racha` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ultima_actividad` date NULL DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_usuario`(`usuario`) USING BTREE,
  UNIQUE INDEX `uq_correo`(`correo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_uca1400_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Maria Torres Lopez', 'Mari12', 'maria@gmail.com', '$2y$10$T6Tq8r0mb05FArZkFFu9WuQMRNY2tLi7G8uxll/QTlHjMNu6HVpYW', NULL, 20, 1, '2026-11-16', '2026-11-16 10:08:39');
INSERT INTO `usuarios` VALUES (2, 'María Hernández López', 'maria.h', 'maria.h@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 170, 1, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (3, 'José Pérez Castillo', 'jose.p', 'jose.p@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 340, 1, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (4, 'Ana Sánchez Díaz', 'ana.s', 'ana.s@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 220, 2, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (5, 'Luis Ramírez Torres', 'luis.r', 'luis.r@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 180, 4, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (6, 'Carmen Gómez Vidal', 'carmen.g', 'carmen.g@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 150, 1, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (7, 'Pedro Jiménez Cruz', 'pedro.j', 'pedro.j@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 120, 2, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (8, 'Lucía Morales Ortiz', 'lucia.m', 'lucia.m@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 90, 1, '2026-11-16', '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (9, 'Diego Vázquez Mena', 'diego.v', 'diego.v@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 60, 0, NULL, '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (10, 'Sofía Reyes Aguilar', 'sofia.r', 'sofia.r@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 40, 0, NULL, '2026-11-16 10:23:27');
INSERT INTO `usuarios` VALUES (11, 'Miguel Cruz Domínguez', 'miguel.c', 'miguel.c@ralyt.test', '$6$ralytsalt12345$Dj/pB9gDRU8NMkDtQg6QYmqsSAe5JKXM5OXYAiKbbmyUDMePIKwQpQv0UE0NpJBQmhXlOHr7axcf/T2D1ZL9/.', NULL, 0, 0, NULL, '2026-11-16 10:23:27');

-- ----------------------------
-- View structure for v_ranking
-- ----------------------------
DROP VIEW IF EXISTS `v_ranking`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_ranking` AS SELECT RANK() OVER (ORDER BY u.puntos DESC) AS posicion, u.id, u.usuario, u.nombre, u.avatar, u.puntos,
       (SELECT COUNT(*) FROM progreso p WHERE p.usuario_id = u.id AND p.completada = 1) AS lecciones_completadas
FROM usuarios u ;

SET FOREIGN_KEY_CHECKS = 1;
