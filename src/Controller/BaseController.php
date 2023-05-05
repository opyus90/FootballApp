<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\FootballTeams;
use Doctrine\ORM\EntityManagerInterface;


class BaseController extends AbstractController
{
	
	/**
     * @Route("/", name="base_router")
     */
    public function viewTeams(EntityManagerInterface $entityManager): Response
    {
		$repository = $entityManager->getRepository(FootballTeams::class)->findAll();
		$teams = array(array());
		$numPlayers = 0;
		foreach ($repository as $row) {
			$players = $row->getPlayers();
			$players = explode(",", $players);
			$count = 0;
			foreach ($players as $player) {
			    $teams[$row->getName()][$count] = $player;
				
				if ($numPlayers < $count) {
					$numPlayers = $count;
				}
				$count++;
			}
		}

		return $this->render('base.html.twig', [
            'teams' => $teams,
			'repository' => $repository,
			'numPlayers' => $numPlayers,
        ]);
    }
	
	/**
     * @Route("/add-football-team", name="add_team")
     */
    public function addFootballTeam(EntityManagerInterface $entityManager, Request $request): Response
    {
		$repository = $entityManager->getRepository(FootballTeams::class)->findAll();
		if ($request->isMethod('POST')) {
			
			$footballTeam = new FootballTeams();
			$footballTeam->setName($request->request->get("name"));
			$footballTeam->setCountry($request->request->get("country"));
			$footballTeam->setMoneyBalance($request->request->get("money_balance"));
			$players = "";
			for ($i = 1; $i < ($request->request->get("number_players")); $i++) {
				
				$players = $players . $request->request->get("player_" . $i) . ",";
				$players = substr($players, 0, -1);
				
			}
			$footballTeam->setPlayers($players);
			
			// tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($footballTeam);
			
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
			
        }
   
        //return new Response('Saved new product with id '.$product->getId());
		return $this->render('addFootballTeam.html.twig', [
			'repository' => $repository,

        ]);
    }
	
	/**
     * @Route("/sell-buy-player", name="sell_buy_player")
     */
    public function sellBuyPlayer(EntityManagerInterface $entityManager, Request $request): Response
    {
		$repository = $entityManager->getRepository(FootballTeams::class);
		$team1 = "";
		$team2 = "";
		
		if (($request->isMethod('POST')) 
			&& ($request->request->get("sell") == "sell")
		) {
			
			$teamPlayer = explode("+", ($request->request->get("player")) );
			$team1 = strval($teamPlayer[0]);
			$team2 = $request->request->get("team2-buy");
			if ($team1 != $team2) {
				$row1 = $repository->findOneBy(['name' => $team1]);
				$balance = $row1->getMoneyBalance();
				$balance = $balance + ($request->request->get("money"));
				$row1->setMoneyBalance($balance);
				$temp = $row1->getPlayers();
				$search = explode(",", $temp);
				$players = "";
				
				foreach ($search as $value) {
					if ($value != $teamPlayer[1]) {

						$players = $players . $value . ",";
						
					}	
				}
				$players = substr($players, 0, -1);
				$row1->setPlayers($players);
				$row2 = $repository->findOneBy(['name' => $team2]);
				$balance = $row2->getMoneyBalance();
				$balance = $balance - ($request->request->get("money"));
				$row2->setMoneyBalance($balance);
				$players = $row2->getPlayers();
				$players = $players . "," . $teamPlayer[1];
				$row2->setPlayers($players);
				
				$entityManager->flush();
				$this->addFlash("success", "Player Sold Successfully!");
			}
			
        }
		
		else if (($request->isMethod('POST')) 
			&& ($request->request->get("buy") == "buy")
		) {
			$teamPlayer = explode("+", ($request->request->get("player")) );
			$team1 = $request->request->get("team1-buy");
			$team2 = strval($teamPlayer[0]);
			if ($team1 != $team2) {
				$row1 = $repository->findOneBy(['name' => $team2]);
				$balance = $row1->getMoneyBalance();
				$balance = $balance + ($request->request->get("money"));
				$row1->setMoneyBalance($balance);
				$temp = $row1->getPlayers();
				$search = explode(",", $temp);
				$players = "";
				
				foreach ($search as $value) {
					if ($value != $teamPlayer[1]) {

						$players = $players . $value . ",";
						
					}	
				}
				$players = substr($players, 0, -1);
				$row1->setPlayers($players);
				
				$row2 = $repository->findOneBy(['name' => $team1]);
				$balance = $row2->getMoneyBalance();
				$balance = $balance - ($request->request->get("money"));
				$row2->setMoneyBalance($balance);
				$players = $row2->getPlayers();
				$players = $players . "," . $teamPlayer[1];
				$row2->setPlayers($players);
				
				$entityManager->flush();
				$this->addFlash('success', 'Player Bought Successfully!');
			}
			
        }
        
        $repository = $entityManager->getRepository(FootballTeams::class)->findAll();
		
		$teams = array(array());
		$numPlayers = 0;
		foreach ($repository as $row) {
			$players = $row->getPlayers();
			$players = explode(",", $players);
			$count = 0;
			foreach ($players as $player) {
			    $teams[$row->getName()][$count] = $player;
				
				if ($numPlayers < $count) {
					$numPlayers = $count;
				}
				$count++;
			}
		}
		
		if (($team1 == $team2) 
			&& (strlen($team1) > 0)
		) {

			$this->addFlash("fail", "Choose different teams");	
		}

		return $this->render('sellBuyPlayer.html.twig', [
			'repository' => $repository,
            'teams' => $teams,
        ]);
    }
}
