CREATE DATABASE the_train;

USE the_train;

CREATE TABLE administrador(
	idAdministrador INT NOT NULL PRIMARY KEY,
    cargo VARCHAR(40) NOT NULL,
    salario DECIMAL(10, 2) NOT NULL,
    idade INT NOT NULL,
    dataNascimento DATE NOT NULL,
    senha VARCHAR(40) NOT NULL,
    email VARCHAR(60) NOT NULL,
    nome VARCHAR(40) NOT NULL,
    cpf VARCHAR(11) NOT NULL
);
    
CREATE TABLE funcionario(
	idFuncionario INT NOT NULL PRIMARY KEY,
    cargo VARCHAR(40) NOT NULL,
    salario DECIMAL(10, 2) NOT NULL,
    idade INT NOT NULL,
    genero VARCHAR(40),
    dataNascimento DATE NOT NULL,
    senha VARCHAR(40) NOT NULL,
    email VARCHAR(60) NOT NULL,
    nome VARCHAR(40) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    idAdministrador INT NOT NULL,
    FOREIGN KEY (idAdministrador) REFERENCES administrador(idAdministrador)
);



CREATE TABLE notificacao(
	idNotificacao INT NOT NULL PRIMARY KEY,
    descricao VARCHAR(40) NOT NULL,
    horario INT NOT NULL,
    tipo VARCHAR(40) NOT NULL
);



CREATE TABLE estacao(
	idEstacao INT NOT NULL PRIMARY KEY,
    nomeEstacao VARCHAR(40) NOT NULL,
    temperatura INT NOT NULL,
    estaChovendo BOOLEAN NOT NULL
);

CREATE TABLE rota(
	idRota INT NOT NULL PRIMARY KEY,
    nome VARCHAR(40) NOT NULL
);

CREATE TABLE trem(
	idTrem INT NOT NULL PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    desempenho VARCHAR(40) NOT NULL,
    consumo INT NOT NULL,
    velocidade DECIMAL(10,2) NOT NULL,
    quantidadePassageiros INT,
    localizacaoX INT,
    localizacaoY INT,
    parado BOOLEAN,
    ativo BOOLEAN,
    idEstacao INT NOT NULL,
    idRota INT NOT NULL,
    FOREIGN KEY (idEstacao) REFERENCES estacao(idEstacao),
    FOREIGN KEY (idRota) REFERENCES rota(idRota)
);






CREATE TABLE manutencao(
	idManutencao INT NOT NULL PRIMARY KEY,
    tipoManutencao VARCHAR(40) NOT NULL,
    estacao VARCHAR(40) NOT NULL,
    descricao VARCHAR(40) NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trem(idTrem)
);

CREATE TABLE avaliacao(
	idAvaliacao INT NOT NULL PRIMARY KEY,
    notaConforto INT NOT NULL,
    notaLimpeza INT NOT NULL,
    notaVistoria INT NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trem(idTrem)
);

CREATE TABLE alerta(
	idFuncionario INT NOT NULL,
    idNotificacao INT NOT NULL,
    FOREIGN KEY (idFuncionario) REFERENCES funcionario(idFuncionario),
    FOREIGN KEY (idNotificacao) REFERENCES notificacao(idNotificacao),
    PRIMARY KEY (idFuncionario, idNotificacao)
);

CREATE TABLE rotaEstacao(
	idRota INT NOT NULL,
    idEstacao INT NOT NULL,
    FOREIGN KEY (idRota) REFERENCES rota(idRota),
    FOREIGN KEY (idEstacao) REFERENCES estacao(idEstacao),
    PRIMARY KEY (idRota, idEstacao)
);

CREATE TABLE trabalha(
	idFuncionario INT NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idFuncionario) REFERENCES funcionario(idFuncionario),
    FOREIGN KEY (idTrem) REFERENCES trem(idTrem),
    PRIMARY KEY (idFuncionario, idTrem)
);
