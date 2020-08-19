-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 08:21 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `employee_deduction` (
`id` int(11) NOT NULL,
  `deduct_id` INT ,
  `emp_id` INT,
  `amount` double NOT NULL,
   FOREIGN KEY (emp_id) REFERENCES employees(id) ON DELETE SET NULL,
   FOREIGN KEY (deduct_id) REFERENCES deductions(id) ON DELETE SET NULL
);


ALTER TABLE `employee_deduction`
ADD PRIMARY KEY (`id`),
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
