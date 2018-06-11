-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-06-2018 a las 23:35:34
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `thuaesuv_ds2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_evaluacion`
--

CREATE TABLE `actividad_evaluacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_indicador_logro` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_formacion`
--

CREATE TABLE `actividad_formacion` (
  `codigo` int(15) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_res_aprendizaje` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_curso` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE `contenidos` (
  `codigo` int(11) NOT NULL,
  `contenido` varchar(171) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contenidos`
--

INSERT INTO `contenidos` (`codigo`, `contenido`) VALUES
(1, 'el concepto de información incompleta'),
(2, 'las variables'),
(3, 'variables'),
(4, 'datos de variables'),
(5, 'las variables que intervienen en diversos casos o procesos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contextos`
--

CREATE TABLE `contextos` (
  `codigo` int(11) NOT NULL,
  `contexto` varchar(171) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contextos`
--

INSERT INTO `contextos` (`codigo`, `contexto`) VALUES
(1, 'de acuerdo a una situación real'),
(2, 'comparándolas'),
(3, 'de acuerdo a una situación real y compleja'),
(4, 'en la elaboración de situaciones de juego'),
(5, 'que intervienen en un proceso o sistema'),
(6, 'intervinientes en casos o sistemas'),
(7, 'asociados a fenómenos naturales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `creditos` int(11) NOT NULL,
  `horas_magistrales` int(11) NOT NULL,
  `horas_independientes` int(11) NOT NULL,
  `validacion` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `habilitacion` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `num_semestre` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_usuario` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`codigo`, `nombre`, `creditos`, `horas_magistrales`, `horas_independientes`, `validacion`, `habilitacion`, `num_semestre`, `tipo`, `codigo_usuario`, `estado`) VALUES
('111048M', 'Álgebra Lineal', 3, 3, 6, 'SI', 'SI', 2, 'Asignatura básica', '200156743', 1),
('111049M', 'Ecuaciones Diferenciales', 3, 3, 6, 'SI', 'SI', 5, 'Asignatura básica', '200213384', 1),
('111052M', 'Cálculo III', 3, 3, 6, 'SI', 'SI', 4, 'Asignatura básica', '1510074', 1),
('111067M', 'Matemáticas Fund.', 5, 4, 11, 'SI', 'SI', 1, 'Asignatura básica', '200156743', 1),
('111070M', 'Cálculo I', 4, 4, 8, 'SI', 'SI', 2, 'Asignatura básica', '200156743', 1),
('111073M', 'Cálculo II', 4, 4, 8, 'SI', 'NO', 3, 'Asignatura básica', '1510074', 1),
('750080M', 'Fundamentos de Programa', 4, 4, 8, 'SI', 'SI', 1, 'Asignatura profesional', '1510074', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_programas`
--

CREATE TABLE `cursos_programas` (
  `id` int(11) NOT NULL,
  `codigo_curso` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_programa` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cursos_programas`
--

INSERT INTO `cursos_programas` (`id`, `codigo_curso`, `codigo_programa`) VALUES
(19, '111049M', '3147'),
(25, '111052M', '2710'),
(26, '111052M', '3743'),
(30, '750080M', '3743'),
(31, '750080M', '2710');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `director` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_facultad` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`codigo`, `nombre`, `director`, `codigo_facultad`, `estado`) VALUES
('Escuela1', 'Escuela de Sistemas y Ciencias de La Computación', NULL, 'Facultad1', 1),
('Escuela2', 'Escuela de Eléctrica y Electrónica', NULL, 'Facultad1', 1),
('Escuela3', 'Escuela de Odontología', NULL, 'Facultad2', 1),
('Escuela4', 'Escuela de Fisioterapia', NULL, 'Facultad2', 1),
('Escuela5', 'Escuela de Química', NULL, 'Facultad3', 1),
('Escuela6', 'Escuela de Matemáticas', NULL, 'Facultad3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `director` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`codigo`, `nombre`, `director`, `estado`) VALUES
('Facultad1', 'Facultad de Ingeniería', '200478634', 1),
('Facultad2', 'Facultad de Salud', '200176598', 1),
('Facultad3', 'Facultad de Ciencias Naturales y Exactas', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador_logro`
--

CREATE TABLE `indicador_logro` (
  `codigo` int(15) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_res_aprendizaje` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prerequisito`
--

CREATE TABLE `prerequisito` (
  `id` int(11) NOT NULL,
  `codigo_curso` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_pre` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `prerequisito`
--

INSERT INTO `prerequisito` (`id`, `codigo_curso`, `codigo_pre`) VALUES
(42, '111049M', '111052M'),
(43, '111052M', '111073M'),
(44, '111052M', '111048M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `num_semestres` int(11) NOT NULL,
  `creditos` int(11) NOT NULL,
  `codigo_escuela` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `director` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`codigo`, `nombre`, `num_semestres`, `creditos`, `codigo_escuela`, `estado`, `director`) VALUES
('21323231', 'Odontología', 10, 170, 'Escuela3', 1, '201134587'),
('2710', 'Tecnología en Sistemas', 7, 100, 'Escuela1', 1, '200834512'),
('3147', 'Matemáticas', 10, 170, 'Escuela6', 1, '1998345786'),
('3743', 'Ingeniería de Sistemas y Computación', 10, 185, 'Escuela1', 1, '200213384'),
('3746', 'Ingeniería Eléctrica', 10, 180, 'Escuela1', 1, '200478634');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propositos`
--

CREATE TABLE `propositos` (
  `codigo` int(11) NOT NULL,
  `proposito` varchar(171) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `propositos`
--

INSERT INTO `propositos` (`codigo`, `proposito`) VALUES
(1, 'al fin de resolver problema teóricos simples'),
(2, 'al fin de explicar fenómenos naturales y geofisicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_aprendizaje`
--

CREATE TABLE `res_aprendizaje` (
  `codigo` int(15) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_competencia` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `codigo` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`codigo`, `rol`, `estado`) VALUES
(1, 'Docente', 1),
(2, 'Director', 1),
(3, 'Decano', 1),
(4, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `primer_nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `segundo_nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primer_apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `segundo_apellido` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `codigo_escuela` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `name`, `rol`, `email`, `password`, `remember_token`, `estado`, `codigo_escuela`) VALUES
('1234543', 'Carlos', NULL, 'Diaz', NULL, 'carlos14', 1, 'carlos@correounivalle.edu.co', '$2y$10$tjLZQAawoZkYg.7lHA/LOOpFTlN2CMAIozqN3KCjbZQDIGpPf1Tsi', 'P5osmwehYt', 0, 'Escuela2'),
('12738383', 'Lucas', NULL, 'Castro', NULL, 'Lukitas', 2, 'lucas@correounivalle.edu.co', '$2y$10$a5cHmwa8dg.NDNGIsYi0KO5xUhDXCnGw0uD8DNyt4w9INj4cJb45S', '3TexntpFPc', 1, 'Escuela4'),
('1510074', 'Diego', 'Fernando', 'Ruiz', NULL, 'diegof', 4, 'diego@correounivalle.edu.co', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'AzVk5H60y0UVxdrEctXB95L2YT4Y8kB158Iad151Z5PeX3o61xqRvUU1W9Uy', 1, 'Escuela1'),
('199545676', 'Teresa', NULL, 'Ramirez', NULL, 'teresita', 2, 'teresa@correounivalle.edu.co', '$2y$10$61h6k1QxuMOH/iYOWf8fWefde3sot667pRjRldJSCefLfosX5mVQ.', 'T6px2l2PPRngzMJpuAysBc5Rtv43oHLHHVSP74AbmedI2MjEGnJ13LW8Gtmz', 1, 'Escuela6'),
('1998345786', 'juan', NULL, 'García', NULL, 'juanjo', 2, 'juan@correounivalle.edu.co', '$2y$10$zrgeq8UyVkqa9hFt.5kEruV2ELLKqny8KE8HrmbyZp6Kl67hzaX3m', 'ncUErxLJhyS62wY9OJjelFtYb9Mb7qUyLn9XryIK65JXfso30T9S2U0tqNmj', 1, 'Escuela5'),
('200156743', 'Rodrigo', NULL, 'Abonía', 'González', 'rodri', 1, 'rodrigo@correounivalle.edu.co', '$2y$10$knfYdakLmmHQ4NdvLexx0OGBasLccHZauytuvzyzpLnaOPenLgSma', 'ln7cx022nIYvbIz8dtokR5yFSKnkuXYFpDoEneSoiKdYoty4L6FwzET9seyI', 1, 'Escuela6'),
('200176598', 'Luis', NULL, 'Ramos', NULL, 'lucho', 3, 'luis@correounivalle.edu.co', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'lwB8igBaHcdt9lElRSBhV567hijfOc10jeRmreOssR45TZVCPcPYmo7mNfmf', 1, NULL),
('200213384', 'Jesus', 'Alexander', 'Aranda', NULL, 'yisus', 2, 'jesus@correounivalle.edu.co', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'rucV6MHNj850pXrTtTfMxBybZ2BZ4NTCvVSYiS8lb123X1dbwvDBnLtBUzeX', 1, 'Escuela1'),
('200334568', 'Beatriz', NULL, 'Florian', NULL, 'betys', 1, 'beatriz@correounivalle.edu.co', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '303abDAoGEswwjV3Tt9wY52REIntJXnP5BC9MJbN6uti0MUjawa8KeD8c1XI', 1, 'Escuela1'),
('2003456877', 'Victor', NULL, 'Vargas', NULL, 'victoripo', 1, 'victor@correounivalle.edu.co', '$2y$10$fmhF1kUjz4kQ5doTkLIACe6uoWtI58qJ83fh1tzj59M8NukcIDKHa', 'qZNwamUv7T', 1, 'Escuela1'),
('200478634', 'Jose', NULL, 'Francox', NULL, 'josep', 3, 'jose@correounivalle.edu.co', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'vyd7vm3XmxopgRE5ZkKladJ0VMjKnzq172lCB291eWsOPWdjbVF190W3lzDD', 1, 'Escuela1'),
('200834512', 'Rafael', NULL, 'Cortéz', NULL, 'rafita', 2, 'rafael@correounivalle.edu.co', '$2y$10$LlbISfMLPvXlmk5RLyRu.eXL7.4318Rpl/RVymHys2Ph9lv/EWT4S', 'hRXkbOOP1wJ3ik7YpovnhKixd3fvmro8b6gGIEDXp2xz6tj9seLMecZMzkOE', 1, 'Escuela1'),
('201134587', 'María', NULL, 'Sanchez', NULL, 'maruja', 2, 'maria@correounivalle.edu.co', '$2y$10$UEjcPtJP8lt3XJyknJ8TleM3/N8syaKLo/33aviU7SOpq.JjFxlIq', 'Yi95oKbZZW4PBfxMXtlIjVCdIg3KheshjbEu7Zk7wrRT9s5C0Hkm41yWLtGf', 1, 'Escuela3'),
('45457897', 'Carlo', NULL, 'Sanchez4', NULL, 'carlitoss', 1, 'carlos12@correounivalle.edu.co', '$2y$10$fneXjFPQ/bfaQl3h4rxF4.mVK6WoM2i8tcUD1JAeXVmJQP6/e3nGG', 'VlZmEMT5uM', 0, 'Escuela2'),
('45689', 'Pedro', NULL, 'Gonzales', NULL, 'pedrorincon', 1, 'pedro@correounivalle.edu.co', '$2y$10$BFLY24/vU.VR..XnTmDy7eGJejRCiG2A3CeUgkvCDIdk0ldw3RfIS', 'ImUMlQXCmC', 1, 'Escuela1'),
('64535', 'Juan', 'Carlos', 'Vargas', NULL, 'carlosvargas12', 1, 'carlos.vargas@correounivalle.edu.co', '$2y$10$LjAhfmU3LD3uS6XAnNWfFemWBcFA65aE5mu52D.fgtoef9cA3KqiC', 'kpdpRlZP0F', 1, 'Escuela3'),
('988954', 'Bruno', 'March', 'Diaz', NULL, 'bat_man', 1, 'bruno.diaz@correounivalle.edu.co', '$2y$10$iTaAgQsJr2C8bLmx1iaGPen.LQHAmJVb2kbDrw0fpYVfalEdypyh6', 'Bn5jj6YKbx', 1, 'Escuela4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verbos`
--

CREATE TABLE `verbos` (
  `codigo` int(11) NOT NULL,
  `verbo` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `verbos`
--

INSERT INTO `verbos` (`codigo`, `verbo`) VALUES
(1, 'Distingue'),
(2, 'Analiza'),
(3, 'Describe'),
(4, 'Recoge'),
(5, 'Compara'),
(6, 'Ejemplifica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad_evaluacion`
--
ALTER TABLE `actividad_evaluacion`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `UNIQUE_codigo` (`codigo`),
  ADD KEY `actividad_evaluacion_indicador_logro_idx` (`codigo_indicador_logro`);

--
-- Indices de la tabla `actividad_formacion`
--
ALTER TABLE `actividad_formacion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `INDEX_codigo` (`codigo`),
  ADD KEY `actividad_formacion_res_aprendizaje_idx` (`codigo_res_aprendizaje`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `INDEX_codigo` (`codigo`),
  ADD KEY `competencias_curso_idx` (`codigo_curso`);

--
-- Indices de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`);

--
-- Indices de la tabla `contextos`
--
ALTER TABLE `contextos`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `INDEX_codigo` (`codigo`) USING BTREE;

--
-- Indices de la tabla `cursos_programas`
--
ALTER TABLE `cursos_programas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cursos_programas_programas_idx` (`codigo_programa`) USING BTREE,
  ADD KEY `fk_cursos_programas_cursos_idx` (`codigo_curso`) USING BTREE;

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `pk_escuela_facultad_idx` (`codigo_facultad`),
  ADD KEY `pk_escuela_usuario_idx` (`director`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fk_facultad_usuario_idx` (`director`);

--
-- Indices de la tabla `indicador_logro`
--
ALTER TABLE `indicador_logro`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `INDEX_codigo` (`codigo`),
  ADD KEY `indicador_logro_res_aprendizaje_idx` (`codigo_res_aprendizaje`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `prerequisito`
--
ALTER TABLE `prerequisito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_codigo` (`id`),
  ADD KEY `fk_prerequisito_curso_idx` (`codigo_curso`),
  ADD KEY `fk_prerequisito_curso_2_idx` (`codigo_pre`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `UNIQUE_codigo` (`codigo`),
  ADD KEY `fk_programa_escuela_idx` (`codigo_escuela`),
  ADD KEY `fk_programa_usuario_idx` (`director`);

--
-- Indices de la tabla `propositos`
--
ALTER TABLE `propositos`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`);

--
-- Indices de la tabla `res_aprendizaje`
--
ALTER TABLE `res_aprendizaje`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `res_aprendizaje_competencias_idx` (`codigo_competencia`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `UNIQUE_codigo` (`codigo`),
  ADD UNIQUE KEY `Unique_email` (`email`),
  ADD UNIQUE KEY `UNIQUE_name` (`name`),
  ADD KEY `fk_usuario_rol_idx` (`rol`),
  ADD KEY `fk_usuario_escuela_idx` (`codigo_escuela`);

--
-- Indices de la tabla `verbos`
--
ALTER TABLE `verbos`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad_evaluacion`
--
ALTER TABLE `actividad_evaluacion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `actividad_formacion`
--
ALTER TABLE `actividad_formacion`
  MODIFY `codigo` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `contextos`
--
ALTER TABLE `contextos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cursos_programas`
--
ALTER TABLE `cursos_programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `indicador_logro`
--
ALTER TABLE `indicador_logro`
  MODIFY `codigo` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `prerequisito`
--
ALTER TABLE `prerequisito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `propositos`
--
ALTER TABLE `propositos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `res_aprendizaje`
--
ALTER TABLE `res_aprendizaje`
  MODIFY `codigo` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `verbos`
--
ALTER TABLE `verbos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_evaluacion`
--
ALTER TABLE `actividad_evaluacion`
  ADD CONSTRAINT `fk_actividad_evaluacion_indicador_logro` FOREIGN KEY (`codigo_indicador_logro`) REFERENCES `indicador_logro` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividad_formacion`
--
ALTER TABLE `actividad_formacion`
  ADD CONSTRAINT `fk_actividad_formacion_res_aprendizaje` FOREIGN KEY (`codigo_res_aprendizaje`) REFERENCES `res_aprendizaje` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD CONSTRAINT `fk_competencias_curso` FOREIGN KEY (`codigo_curso`) REFERENCES `curso` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursos_programas`
--
ALTER TABLE `cursos_programas`
  ADD CONSTRAINT `fk_cursos_programas_curso` FOREIGN KEY (`codigo_curso`) REFERENCES `curso` (`codigo`),
  ADD CONSTRAINT `fk_cursos_programas_programa` FOREIGN KEY (`codigo_programa`) REFERENCES `programa` (`codigo`);

--
-- Filtros para la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD CONSTRAINT `pk_escuela_facultad` FOREIGN KEY (`codigo_facultad`) REFERENCES `facultad` (`codigo`),
  ADD CONSTRAINT `pk_escuela_usuario` FOREIGN KEY (`director`) REFERENCES `usuario` (`codigo`);

--
-- Filtros para la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD CONSTRAINT `fk_facultad_usuario` FOREIGN KEY (`director`) REFERENCES `usuario` (`codigo`);

--
-- Filtros para la tabla `indicador_logro`
--
ALTER TABLE `indicador_logro`
  ADD CONSTRAINT `fk_indicador_logro_res_aprendizaje` FOREIGN KEY (`codigo_res_aprendizaje`) REFERENCES `res_aprendizaje` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prerequisito`
--
ALTER TABLE `prerequisito`
  ADD CONSTRAINT `fk_prerequisito_curso_1` FOREIGN KEY (`codigo_curso`) REFERENCES `curso` (`codigo`),
  ADD CONSTRAINT `fk_prerequisito_curso_2` FOREIGN KEY (`codigo_pre`) REFERENCES `curso` (`codigo`);

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `fk_programa_escuela` FOREIGN KEY (`codigo_escuela`) REFERENCES `escuela` (`codigo`),
  ADD CONSTRAINT `fk_programa_usuario` FOREIGN KEY (`director`) REFERENCES `usuario` (`codigo`);

--
-- Filtros para la tabla `res_aprendizaje`
--
ALTER TABLE `res_aprendizaje`
  ADD CONSTRAINT `fk_res_aprendizaje_competencias` FOREIGN KEY (`codigo_competencia`) REFERENCES `competencias` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_escuela` FOREIGN KEY (`codigo_escuela`) REFERENCES `escuela` (`codigo`),
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`codigo`);
