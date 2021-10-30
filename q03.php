/** Você foi contratado para desenvolver em PHP o sistema de controle de alunos do
 * CEDERJ. Utilizando o paradigma de orientação a objetos, você mapeou as seguintes
 * classes: Aluno, Disciplina e TurmasDisciplina. A dinâmica é a seguinte: os
 * alunos se inscrevem nas disciplinas e o sistema deve informar quantas turmas serão
 * necessárias e quais os alunos inscritos em cada uma delas. O número de turmas
 * depende do número máximo de alunos por turma (nmax). Portanto, se o número de
 * inscrições passar o número máximo de alunos por turma, o sistema deve abrir uma nova
 * turma e assim por diante até que todos os alunos estejam em uma turma.
 * Os alunos são organizados por turma por ordem de CR (Coeficiente de Rendimento -
 * média ponderada de todas as disciplinas cursadas). Assim, os alunos com os nmax
 * maiores CRs são alocados na primeira turma e assim por diante. Ao final, garante-se que todos os alunos são alocados em uma turma da disciplina. Não há limite máximo para o
 * número de turmas. A listagem abaixo mostra os atributos das classes, o código usado
 * para instanciar as classes e testar a lógica da programação. Ao final, espera-se que
 * seja exibido na tela o número de turmas e a lista, por turma, de nomes de alunos 
 * e respectivos CRs. Pede-se para apresentar a implementação completa, levando em conta
 * que a listagem abaixo pode omitir alguns métodos e atributos, que devem ser parte 
 * da resposta.
*/

<?php

	class Aluno {
		private $nome, $cr;
		
		function __construct($nome, $cr) {
			$this->nome = $nome;
			$this->cr = $cr;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function getCr(){
			return $this->cr;
		}
		
		public function inscreveDisciplina($disciplina){
			$disciplina->setAluno($this);
		}	
	
	}
	
	class Disciplina {
		
		private $alunosInscritos = array();
		private $nomeDisciplina;
		
		public function __construct($nome) {
			$this->nome = $nome;			
		}	
		
		public function getNome(){
			return $this->nomeDisciplina;
		}	
		
		public function getAlunosInscritos(){
			return $this->alunosInscritos;
		}
		
		public function setAluno($aluno){
			array_push($this->alunosInscritos, $aluno);
		}
	}
	
	class TurmasDisciplina {
		private $turmas = array(); // array de arrays de turmas
		private $nmax;
		
		public function __construct($maxAlunos) {
			$this->nmax = $maxAlunos;			
		}	
		
		static function compara($a, $b){
			if ( $a->getCr() == $b->getCr() ) return 0;
			return ($a->getCr() < $b->getCr() ) ?  1 : -1;
		}
		
		public function getNMax(){
			return $this->nmax;
		}
		
		public function getTurmas(){
			return $this->turmas;
		}
		
		public function setTurmas($turmas){
			$this->turmas = $turmas;
		}
		
		public function calculaTurmas($disciplina){
			$alunos = $disciplina->getAlunosInscritos();
			usort($alunos, array($this, "compara"));
			$turmas = array_chunk($alunos, $this->getNMax());
			$this->setTurmas($turmas);
		}
		
		public function imprimeTurmas(){
			foreach ($this->getTurmas() as $keyTurma => $valueTurma){
				echo "----------- \n";
				echo "Turma {$keyTurma} : \n";
				foreach ($valueTurma as $keyAluno => $valueAluno){
					echo "- Nome: {$valueAluno->getNome()}, CR: {$valueAluno->getCr()} \n";
				}
				echo "----------- \n \n";
			}
		}			
		
	}
	
	$aluno1 = new Aluno ("João", 8.5);
	$aluno2 = new Aluno ("Ana", 9.0);
	$aluno3 = new Aluno ("Maria", 9.5);
    $aluno4 = new Aluno ("Anderson", 6.5);
    $aluno5 = new Aluno ("Valéria", 7.5);
    $aluno6 = new Aluno ("Camila", 5.0);
    $aluno7 = new Aluno ("Paulo", 8.0);
	
	$disciplina1 = new Disciplina("PAW");
	
	$turmasDisciplina = new TurmasDisciplina(2); // $nmax = 2
	$aluno1->inscreveDisciplina($disciplina1);
	$aluno2->inscreveDisciplina($disciplina1);
	$aluno3->inscreveDisciplina($disciplina1);
    $aluno4->inscreveDisciplina($disciplina1);
    $aluno5->inscreveDisciplina($disciplina1);
    $aluno6->inscreveDisciplina($disciplina1);
    $aluno7->inscreveDisciplina($disciplina1);
	
	$turmasDisciplina->calculaTurmas($disciplina1);
	$turmasDisciplina->imprimeTurmas();
	
?>
