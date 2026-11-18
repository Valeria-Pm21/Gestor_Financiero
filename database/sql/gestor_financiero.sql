-- =====================================================
-- GESTOR FINANCIERO - Estructura de la base de datos
-- =====================================================
 
CREATE DATABASE IF NOT EXISTS gestor_financiero
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
 
USE gestor_financiero;
 
-- Se borran en este orden porque transacciones depende de las otras dos
DROP TABLE IF EXISTS transacciones;
DROP TABLE IF EXISTS cuentas;
DROP TABLE IF EXISTS categorias;
 
 
-- =====================================================
-- TABLA CATEGORIAS
-- =====================================================
CREATE TABLE categorias (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    tipo ENUM('ingreso', 'gasto') NOT NULL,
    descripcion VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB;
 
 
-- =====================================================
-- TABLA CUENTAS
-- =====================================================
CREATE TABLE cuentas (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255) NULL,
    saldo DECIMAL(18,2) NOT NULL DEFAULT 0.00,
    moneda VARCHAR(10) DEFAULT 'COP',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB;
 
 
-- =====================================================
-- TABLA TRANSACCIONES
-- =====================================================
CREATE TABLE transacciones (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cuenta_id BIGINT UNSIGNED NOT NULL,
    categoria_id BIGINT UNSIGNED NOT NULL,
    tipo ENUM('ingreso', 'gasto') NOT NULL,
    monto DECIMAL(18,2) NOT NULL,
    fecha DATE NOT NULL,
    descripcion VARCHAR(255) NULL,
    creado_por VARCHAR(150) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
 
    CONSTRAINT fk_transacciones_cuenta
        FOREIGN KEY (cuenta_id)
        REFERENCES cuentas(id)
        ON DELETE RESTRICT,
 
    CONSTRAINT fk_transacciones_categoria
        FOREIGN KEY (categoria_id)
        REFERENCES categorias(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB;