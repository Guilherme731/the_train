CREATE DATABASE the_train_db;

USE the_train_db;   
    
CREATE TABLE usuarios(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cargo ENUM('Administrador', 'Mecânico', 'Faxineiro', 'Supervisor', 'Operário', 'Piloto') NOT NULL,
    salario DECIMAL(10, 2) NOT NULL,
    genero ENUM('Feminino', 'Masculino', 'Prefiro não dizer', 'Outro') NOT NULL,
    dataNascimento DATE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    nome VARCHAR(120) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    tipo ENUM('admin', 'funcionario') NOT NULL,
    imagemPerfil VARCHAR(120) NULL
);

CREATE TABLE notificacoes(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    descricao VARCHAR(120) NULL,
    horario TIME NOT NULL,
    tipo ENUM('Chuva', 'Atraso', 'Falha Mecanica') NOT NULL
);

CREATE TABLE estacoes(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nomeEstacao ENUM('Estação Aurora', 'Estação Vila Nova', 'Estação Vale Verde', 'Estação São Pedro') NOT NULL,
    temperatura DECIMAL NOT NULL,
    estaChovendo BOOLEAN NOT NULL
);

CREATE TABLE rotas(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nome VARCHAR(120) UNIQUE NOT NULL
);

CREATE TABLE trens(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nome VARCHAR(120) UNIQUE NOT NULL,
    desempenho VARCHAR(120) NOT NULL,
    consumo INT NOT NULL,
    velocidade DECIMAL(10,2) NOT NULL,
    quantidadePassageiros INT,
    localizacaoX INT,
    localizacaoY INT,
    parado BOOLEAN,
    ativo BOOLEAN,
    idEstacao INT NOT NULL,
    idRota INT NOT NULL,
    FOREIGN KEY (idEstacao) REFERENCES estacoes(id),
    FOREIGN KEY (idRota) REFERENCES rotas(id)
);

CREATE TABLE manutencoes(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tipoManutencao VARCHAR(120) NOT NULL,
    idEstacao INT NOT NULL,
    descricao VARCHAR(120) NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trens(id),
    FOREIGN KEY (idEstacao) REFERENCES estacoes(id)
);

CREATE TABLE avaliacoes(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    notaConforto INT NOT NULL,
    notaLimpeza INT NOT NULL,
    notaVistoria INT NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trens(id)
);

CREATE TABLE alertas(
	idFuncionario INT NOT NULL,
    idNotificacao INT NOT NULL,
    FOREIGN KEY (idFuncionario) REFERENCES usuarios(id),
    FOREIGN KEY (idNotificacao) REFERENCES notificacoes(id),
    PRIMARY KEY (idFuncionario, idNotificacao)
);

CREATE TABLE rotasEstacoes(
	idRota INT NOT NULL,
    idEstacao INT NOT NULL,
    FOREIGN KEY (idRota) REFERENCES rotas(id),
    FOREIGN KEY (idEstacao) REFERENCES estacoes(id),
    PRIMARY KEY (idRota, idEstacao)
);

CREATE TABLE trabalha(
	idFuncionario INT NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idFuncionario) REFERENCES usuarios(id),
    FOREIGN KEY (idTrem) REFERENCES trens(id),
    PRIMARY KEY (idFuncionario, idTrem)
);

CREATE TABLE sensores(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('Sensor de umidade', 'Sensor de temperatura', 'Sensor de luminosidade') NOT NULL,
    descricao VARCHAR(240) NULL,
    status ENUM('Em funcionamento', 'Em manutenção', 'Em pausa') NOT NULL
);

CREATE TABLE sensores_data(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sensores INT NOT NULL,
    valor INT NOT NULL,
    data_hora DATETIME NOT NULL,
    CONSTRAINT fk_sensores_id FOREIGN KEY (id_sensores) REFERENCES sensores(id)
);

INSERT INTO usuarios (`cargo`, `salario`, `genero`, `dataNascimento`, `senha`, `email`, `nome`, `cpf`, `tipo`) VALUES
('Administrador', '5000', 'Feminino', '1997-04-27', '$2y$10$UQ8NEEGJMhR27KYLr6JwAOoa6YOXyrbF8jwiirn2QbgcG3eDmBJEC', 'admin@thetrain.com', 'Admin', '99999999999', 'admin'),
('Operário', '3000', 'Masculino', '1999-05-27', '$2y$10$FXEtBMctNaZfGFhEG9cYgOcROkb0z.2xEayu9JKbZuWVg8L/0OisO', 'user@thetrain.com', 'Usuario', '99999999998', 'funcionario'),
('Faxineiro', '2500', 'Masculino', '2008-03-23', '$2y$10$Rsbvwg2x95QebiQdyls6jeoRMhphc59FE4SpS.fONeu7Bn4L/wU4K', 'rodrigo@thetrain.com', 'Rodrigo', '77777777777', 'funcionario');

INSERT INTO notificacoes(horario, tipo)
VALUES
('12:20:00', 'Chuva'),
('8:20:00', 'Atraso'),
('2:20:10', 'Falha Mecânica');

INSERT INTO estacoes(nomeEstacao, temperatura, estaChovendo)
VALUES
('Estação Aurora', 23.3, TRUE),
('Estação Vila Nova', 25.3, FALSE),
('Estação Vale Verde', 15.3, TRUE);

INSERT INTO rotas(nome)
VALUES
('Rota Norte'),
('Rota Sul'),
('Rota Central');

INSERT INTO trens(nome, desempenho, consumo, velocidade, quantidadePassageiros, localizacaoX, localizacaoY, parado, ativo, idEstacao, idRota)
VALUES
('Trem Expresso 1', 'Alto', 300, 120.50, 200, 10, 20, FALSE, TRUE, 1, 1),
('Trem Regional 2', 'Médio', 400, 90.00, 150, 15, 25, TRUE, TRUE, 2, 2),
('Trem Urbano 3', 'Baixo', 200, 60.75, 100, 8, 12, FALSE, FALSE, 3, 3);

INSERT INTO manutencoes(tipoManutencao, idEstacao, idTrem)
VALUES
('Revisão Elétrica', 1, 3),
('Manutenção Preventiva', 2, 2),
('Reparo de Freios', 3, 1);

INSERT INTO avaliacoes(notaConforto, notaLimpeza, notaVistoria, idTrem)
VALUES
(8, 9, 2, 3),
(3, 5, 2, 1),
(10, 3, 9, 2);

INSERT INTO sensores(tipo, status, descricao)
VALUES
('Sensor de temperatura', 'Em funcionamento', 'O sensor de temperatura está medindo de forma correta e coerente.'),
('Sensor de Umidade', 'Em manutenção', 'O sensor de umidade está em manutenção no momento, devido a um erro encontrado no sistema.'),
('Sensor de Luminosidade', 'Em pausa', 'O sensor de luminosidade está em pausa no momento, devido a um erro grave que precisa ser consertado.');

INSERT INTO sensores_data(id_sensores, valor, data_hora)
VALUES
(1, 23, '2025-09-26 14:30:00'),
(2, 40, '2025-03-09 15:20:10'),
(3, 30, '2025-06-10 16:10:50');