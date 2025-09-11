CREATE DATABASE the_train_db;

USE the_train;
    
CREATE TABLE usuarios(
	id INT NOT NULL PRIMARY KEY,
    cargo VARCHAR(120) NOT NULL, /* emum */
    salario DECIMAL(10, 2) NOT NULL,
    genero VARCHAR(40),
    dataNascimento DATE NOT NULL,
    senha VARCHAR(40) NOT NULL,
    email VARCHAR(255) NOT NULL,
    nome VARCHAR(120) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    tipo EMUM('admin', 'funcionario') NOT NULL
);

CREATE TABLE notificacoes(
	id INT NOT NULL PRIMARY KEY,
    descricao VARCHAR(120) NOT NULL,
    horario INT NOT NULL,
    tipo VARCHAR(120) NOT NULL /* emum */
);

CREATE TABLE estacoes(
	id INT NOT NULL PRIMARY KEY,
    nomeEstacao VARCHAR(120) NOT NULL, /* emum */
    temperatura INT NOT NULL,
    estaChovendo BOOLEAN NOT NULL
);

CREATE TABLE rotas(
	id INT NOT NULL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL
);

CREATE TABLE trens(
	id INT NOT NULL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
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
	id INT NOT NULL PRIMARY KEY,
    tipoManutencao VARCHAR(120) NOT NULL,
    estacao VARCHAR(120) NOT NULL, /* emum */
    descricao VARCHAR(120) NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trens(id)
);

CREATE TABLE avaliacoes(
	id INT NOT NULL PRIMARY KEY,
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