
CREATE TABLE `account` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int DEFAULT NULL
);

INSERT INTO `account` (`id`, `email`, `password`, `role`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', NULL),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', NULL);

ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
  
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;