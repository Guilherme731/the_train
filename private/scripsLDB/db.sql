CREATE DATABASE the_train_db;

USE the_train_db;   
    
CREATE TABLE usuarios(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cargo ENUM('Administrador', 'Mecânico', 'Faxineiro', 'Supervisor', 'Operário', 'Piloto') NOT NULL,
    salario DECIMAL(10, 2) NOT NULL,
    genero ENUM('Feminino', 'Masculino', 'Prefiro não dizer', 'Outro') NOT NULL,
    dataNascimento DATE NOT NULL,
    senha VARCHAR(40) NOT NULL,
    email VARCHAR(255) NOT NULL,
    nome VARCHAR(120) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    tipo ENUM('admin', 'funcionario') NOT NULL
);

CREATE TABLE notificacoes(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    descricao VARCHAR(120) NOT NULL,
    horario INT NOT NULL,
    tipo ENUM('Chuva', 'Atraso', 'Falha Mecanica') NOT NULL
);

CREATE TABLE estacoes(
	id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nomeEstacao ENUM('Estação Aurora', 'Estação Vila Nova', 'Estação Vale Verde', 'Estação São Pedro') NOT NULL,
    temperatura INT NOT NULL,
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
    estacao ENUM('Estação Aurora', 'Estação Vila Nova', 'Estação Vale Verde', 'Estação São Pedro') NOT NULL,
    descricao VARCHAR(120) NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trens(id)
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

INSERT INTO usuarios(`cargo`, `salario`, `genero`, `dataNascimento`, `senha`, `email`, `nome`, `cpf`, `tipo`) VALUES
('Administrador', '5000', 'Feminino', '1997-04-27', 'admin', 'admin@thetrain.com', 'Admin', '99999999999', 'admin'),
('Operário', '3000', 'Masculino', '1999-05-27', 'user', 'user@thetrain.com', 'Usuario', '99999999998', 'funcionario');