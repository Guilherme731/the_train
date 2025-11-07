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
    cep VARCHAR(8) NOT NULL,
    rua VARCHAR(255),
    cidade VARCHAR(255),
    estado VARCHAR(255),
    numero INT,
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
    desempenho INT NOT NULL,
    mes ENUM('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro') NOT NULL,
    consumo INT NOT NULL,
    velocidade DECIMAL(10,2) NOT NULL,
    quantidadePassageiros INT,
    localizacaoX INT,
    localizacaoY INT,
    parado BOOLEAN,
    ativo BOOLEAN,
    idEstacao INT NOT NULL,
    idRota INT NOT NULL,
    horaSaida TIME,
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

CREATE TABLE mensagens(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('duvida', 'reportarErro', 'marcarAudiencia') NOT NULL,
    id_remetente INT NOT NULL,
    id_destinatario INT NOT NULL,
    conteudo TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_remetente) REFERENCES usuarios(id),
    FOREIGN KEY (id_destinatario) REFERENCES usuarios(id)
);

INSERT INTO usuarios (`cargo`, `salario`, `genero`, `dataNascimento`, `senha`, `email`, `nome`, `cpf`, `tipo`, `imagemPerfil`, `cep`, `rua`, `cidade`, `estado`, `numero`) VALUES
('Administrador', '5000', 'Feminino', '1997-04-27', '$2y$10$UQ8NEEGJMhR27KYLr6JwAOoa6YOXyrbF8jwiirn2QbgcG3eDmBJEC', 'admin@thetrain.com', 'Admin', '99999999999', 'admin', null, '89202205', 'Av. Getúlio Vargas', 'Joinville', 'Santa Catarina', 463),
('Operário', '3000', 'Masculino', '1999-05-27', '$2y$10$FXEtBMctNaZfGFhEG9cYgOcROkb0z.2xEayu9JKbZuWVg8L/0OisO', 'user@thetrain.com', 'Usuario', '99999999998', 'funcionario', 'perfilUsuario2.png', '81580290', 'Rua Tenente Coronel Benjamin Lage', 'Curitiba', 'Paraná', 52),
('Faxineiro', '2500', 'Masculino', '2008-03-23', '$2y$10$Rsbvwg2x95QebiQdyls6jeoRMhphc59FE4SpS.fONeu7Bn4L/wU4K', 'rodrigo@thetrain.com', 'Rodrigo', '77777777777', 'funcionario', 'perfilUsuario3.png', '89258110', 'R. José Pavanelo', 'Jaraguá do Sul', 'Santa Catarina', 205);

INSERT INTO notificacoes(horario, tipo, descricao)
VALUES
('12:20:00', 'Chuva', 'Chuva forte na rota 3, possível risco a passageiros e/ou funcionários.'),
('8:20:00', 'Atraso', 'Atraso na rota 1 devido a animal ferido na linha.'),
('2:20:10', 'Falha Mecânica', 'Requisição de manutenção para o trem 2, problema de desgaste do eixo que gerou a quebra das rodas.'); 

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

INSERT INTO trens(nome, mes, desempenho, consumo, velocidade, quantidadePassageiros, localizacaoX, localizacaoY, parado, ativo, horaSaida, idEstacao, idRota)
VALUES
('Trem Expresso 1', 'Abril', 85, 300, 120.50, 200, 10, 20, FALSE, TRUE, '12:23', 1, 1),
('Trem Regional 2', 'Maio', 89, 400, 90.00, 150, 15, 25, TRUE, TRUE, '12:27', 2, 2),
('Trem Urbano 3', 'Junho', 95, 200, 60.75, 100, 8, 12, FALSE, FALSE, '12:24', 3, 3);

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


INSERT INTO alertas(idFuncionario, idNotificacao)
VALUES
(1, 2),
(3, 1),
(2, 3),
(3, 3),
(2, 1);

INSERT INTO mensagens(tipo, id_destinatario, id_remetente, conteudo, data_envio)
VALUES
('duvida', 1, 1, 'Não entendi como funciona as notificações, como eu poderia criar uma nova?', '2025-03-02'),
('reportarErro', 1, 2, 'Não estou conseguindo fazer login, mesmo meu email estando correto.', '2025-06-04'),
('marcarAudiencia', 1, 3, 'Gostaria de marcar uma audiência para o dia 20/11/2025 para discutir os termos do projeto.', '2025-11-06');