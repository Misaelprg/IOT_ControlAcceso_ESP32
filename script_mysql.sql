USE access_control_se;

CREATE TABLE workers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  paternal_lastname VARCHAR(50) NOT NULL,
  maternal_lastname VARCHAR(50) NOT NULL,
  area VARCHAR(50) NOT NULL,
  worker_code VARCHAR(5) NOT NULL,
  finger_id INT UNIQUE
);

CREATE TABLE registers_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  worker_id INT NOT NULL,
  date DATETIME NOT NULL,
  action ENUM('entrada', 'salida') NOT NULL,
  FOREIGN KEY (worker_id) REFERENCES workers(id)
);

SELECT w.name, w.paternal_lastname, w.maternal_lastname, w.area, w.worker_code, r.date, r.action
FROM workers AS w
JOIN registers_records AS r ON w.id = r.worker_id
WHERE DATE(r.date) = '2024-10-23'
ORDER BY r.date;

SELECT * FROM workers;

INSERT INTO workers (name, paternal_lastname, maternal_lastname, area, worker_code)
VALUES
('Juan', 'Pérez', 'López', 'Administración', 'A001'),
('María', 'González', 'Ramírez', 'Ventas', 'V002'),
('Luis', 'Martínez', 'Díaz', 'Producción', 'P003'),
('Ana', 'Hernández', 'Sánchez', 'Recursos Humanos', 'R004'),
('Carlos', 'Fernández', 'Moreno', 'IT', 'I005'),
('Pedro', 'López', 'García', 'Finanzas', 'F006'),
('Sofía', 'Ramírez', 'Cruz', 'Logística', 'L007'),
('Jorge', 'Mendoza', 'Torres', 'Compras', 'C008'),
('Fernanda', 'Rodríguez', 'Ramos', 'Ventas', 'V009'),
('Andrés', 'Castillo', 'Martínez', 'Producción', 'P010'),
('Valeria', 'Gómez', 'Flores', 'Administración', 'A011'),
('Ricardo', 'Salinas', 'Ortiz', 'Finanzas', 'F012'),
('Claudia', 'Mejía', 'Bautista', 'Recursos Humanos', 'R013'),
('Fernando', 'Ríos', 'Alvarado', 'Logística', 'L014'),
('Andrea', 'Vargas', 'Reyes', 'IT', 'I015'),
('Diego', 'Jiménez', 'Pineda', 'Producción', 'P016'),
('Laura', 'Morales', 'Vázquez', 'Compras', 'C017'),
('Raúl', 'Silva', 'Navarro', 'Ventas', 'V018'),
('Gabriela', 'Romero', 'Aguilar', 'Administración', 'A019'),
('Miguel', 'Domínguez', 'Cortés', 'Finanzas', 'F020'),
('Paola', 'Santos', 'Luna', 'Recursos Humanos', 'R021'),
('Santiago', 'Paredes', 'Hernández', 'Producción', 'P022'),
('Monserrat', 'Durán', 'Campos', 'IT', 'I023'),
('Javier', 'Chávez', 'Fernández', 'Logística', 'L024'),
('Alicia', 'Suárez', 'García', 'Compras', 'C025'),
('Gerardo', 'Vega', 'Escobar', 'Ventas', 'V026'),
('Fabiola', 'Sandoval', 'Lara', 'Recursos Humanos', 'R027'),
('Roberto', 'Ponce', 'Serrano', 'Producción', 'P028'),
('Diana', 'Palacios', 'Rivera', 'Administración', 'A029'),
('Hugo', 'Medina', 'Carvajal', 'Finanzas', 'F030'),
('Brenda', 'Acosta', 'Zamora', 'IT', 'I031'),
('Alonso', 'Cortés', 'Maldonado', 'Logística', 'L032'),
('Natalia', 'Molina', 'Santiago', 'Compras', 'C033'),
('Víctor', 'Blanco', 'Núñez', 'Ventas', 'V034'),
('Rosa', 'Martínez', 'Pérez', 'Recursos Humanos', 'R035'),
('Patricia', 'Carrillo', 'Franco', 'Producción', 'P036'),
('Oscar', 'Moreno', 'Castro', 'Administración', 'A037'),
('Daniela', 'Rivas', 'Peña', 'Finanzas', 'F038'),
('Manuel', 'Escobar', 'Guzmán', 'IT', 'I039'),
('Graciela', 'León', 'Vargas', 'Logística', 'L040'),
('César', 'González', 'Ramírez', 'Compras', 'C041'),
('Isabel', 'Bautista', 'Flores', 'Ventas', 'V042'),
('Joaquín', 'Álvarez', 'Montoya', 'Producción', 'P043'),
('Tania', 'Ortiz', 'Méndez', 'Recursos Humanos', 'R044'),
('Álvaro', 'Serrano', 'Cisneros', 'Finanzas', 'F045'),
('Liliana', 'Navarro', 'Padilla', 'Administración', 'A046'),
('Héctor', 'Rivera', 'Zavala', 'Logística', 'L047'),
('Camila', 'Cabrera', 'Trejo', 'IT', 'I048'),
('René', 'Solís', 'Quintero', 'Compras', 'C049'),
('Iván', 'Orozco', 'Herrera', 'Ventas', 'V050');

INSERT INTO registers_records (worker_id, date, action)
VALUES
(1, '2024-10-23 08:00:00', 'entrada'),  -- Entrada de Juan Pérez
(2, '2024-10-23 08:15:00', 'entrada'),  -- Entrada de María González
(3, '2024-10-23 08:30:00', 'entrada'),  -- Entrada de Luis Martínez
(4, '2024-10-23 08:45:00', 'entrada'),  -- Entrada de Ana Hernández
(5, '2024-10-23 09:00:00', 'entrada'),  -- Entrada de Carlos Fernández
(1, '2024-10-23 17:00:00', 'salida'),   -- Salida de Juan Pérez
(2, '2024-10-23 17:15:00', 'salida'),   -- Salida de María González
(3, '2024-10-23 17:30:00', 'salida'),   -- Salida de Luis Martínez
(4, '2024-10-23 17:45:00', 'salida'),   -- Salida de Ana Hernández
(5, '2024-10-23 18:00:00', 'salida');   -- Salida de Carlos Fernández
