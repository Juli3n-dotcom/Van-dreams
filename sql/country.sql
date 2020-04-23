INSERT INTO `country` (`id_country`, `name`) VALUES
(1, 'France'),
(2, 'Belgique'),
(3, 'Suisse'),
(4, 'Luxembourg'),
(5, 'Canada'),
(6, 'Australie'),
(7, 'Nouvelle Zélande'),
(8, 'USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id_country`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id_country` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;