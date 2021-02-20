<?php

namespace App\Controller;

use App\Entity\WorkingTime;
use App\Form\WorkingTimeType;
use App\Repository\WorkerRepository;
use App\Repository\WorkingTimeRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/workingtime")
 */
class WorkingTimeController extends AbstractController
{

    /**
     * @Route("/", name="working_time_index", methods={"GET"})
     */
    public function index(Request $request,WorkingTimeRepository $workingTimeRepository, WorkerRepository $workerRepository): Response
    {
        $orderBy = $request->query->get('orderBy');
        $workers = $workerRepository->findAll();
        if (!empty($workers)) {
                return $this->render('working_time/index.html.twig', [
                    'working_times' => $workingTimeRepository->findAllOrderBy($orderBy),
                ]);
        } else {
            return $this->render('working_time/index.error.html.twig');
        }
    }

    /**
     * @Route("/new", name="working_time_new", methods={"GET","POST"})
     */
    public function new(Request $request, WorkingTimeRepository $workingTimeRepository, LoggerInterface $logger): Response
    {
        $workingTime = new WorkingTime();
        $form = $this->createForm(WorkingTimeType::class, $workingTime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $foundResult = $workingTimeRepository->findOneBy(["date" => $workingTime->getDate(),"worker_id" => $workingTime->getWorkerId()]);
            $workingTime->setInHour($this->calculateWorkingTime($workingTime, $logger));
            $workingTime->setWeekendBonus($this->calculateWeekendBonus($workingTime, $logger));
            $entityManager = $this->getDoctrine()->getManager();
            if (!empty($foundResult)) {
                $foundResult->setStart($workingTime->getStart());
                $foundResult->setEnd($workingTime->getEnd());
                $foundResult->setInHour($workingTime->getInHour());
                $foundResult->setWeekendBonus($workingTime->getWeekendBonus());
            }else{
                $entityManager->persist($workingTime);
            }
            $entityManager->flush();
            return $this->redirectToRoute('working_time_index');
        }

        return $this->render('working_time/new.html.twig', [
            'working_time' => $workingTime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="working_time_show", methods={"GET"})
     */
    public function show(WorkingTime $workingTime): Response
    {
        return $this->render('working_time/show.html.twig', [
            'working_time' => $workingTime,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="working_time_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WorkingTime $workingTime, LoggerInterface $logger): Response
    {
        $form = $this->createForm(WorkingTimeType::class, $workingTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workingTime->setInHour($this->calculateWorkingTime($workingTime, $logger));
            $workingTime->setWeekendBonus($this->calculateWeekendBonus($workingTime, $logger));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('working_time_index');
        }

        return $this->render('working_time/edit.html.twig', [
            'working_time' => $workingTime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="working_time_delete", methods={"GET"})
     */
    public function delete(WorkingTime $workingTime): Response
    {
        if ($workingTime) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workingTime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('working_time_index');
    }

    private function calculateWorkingTime(WorkingTime $workingTime, $diff = 0): float
    {
        $startHour = $this->explodeTime($workingTime->getStart(), 0);
        $startMinute = $this->explodeTime($workingTime->getStart(), 1);
        $endHour = $this->explodeTime($workingTime->getEnd(), 0);
        $endMinute = $this->explodeTime($workingTime->getEnd(), 1);
        if (($startHour > $endHour) || ($startHour == $endHour && $startMinute > $endMinute)) {
            $starDateTime = $this->convertToDateTime($workingTime->getDate(), $workingTime->getStart());
            $endDateTime = $this->convertToDateTime($workingTime->getDate(), $workingTime->getEnd(), 1);
            $diff = $starDateTime->diff($endDateTime);
        } else {
            $starDateTime = $this->convertToDateTime($workingTime->getDate(), $workingTime->getStart());
            $endDateTime = $this->convertToDateTime($workingTime->getDate(), $workingTime->getEnd());
            $diff = $starDateTime->diff($endDateTime);
        }
        $calculatedDiff = $diff->h;
        $calculatedDiff += ($diff->i) / 60;

        return round($calculatedDiff, 1);
    }

    public function calculateWeekendBonus(WorkingTime $workingTime, $workingHour = 0): float
    {
        $dayNo = date('w', strtotime($workingTime->getDate()->format("Y-m-d")));
        if (($dayNo == 6 || $dayNo == 0) && $workingTime->getWorkerId()->getBirthdate()->diff(new \DateTime())->y < 18) {
            if ($workingHour == 0) {
                $workingHour = $this->calculateWorkingTime($workingTime);
            }
            $workingHour = $workingHour * 0.5;
        } else {
            $workingHour = 0;
        }
        return $workingHour;
    }

    private function convertToDateTime($date, $time, $diffDay = 0): \DateTime
    {
        $dateArray = explode("-", $date->format("Y-m-d"));
        $dateTime = new \DateTime();
        $hour = $this->explodeTime($time, 0);
        $minute = $this->explodeTime($time, 1);
        $dateTime->setDate(intval($dateArray[0]), intval($dateArray[1]), intval($dateArray[2]) + $diffDay);
        $dateTime->setTime($hour, $minute);
        return $dateTime;
    }

    private function explodeTime($time, $tag): int
    {
        return intval(explode(":", $time->format("H:i:s"))[$tag]);;
    }
}
