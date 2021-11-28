<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\UserFollowingRepository;
use App\Entity\User;
use App\Entity\UserFollowing;

class PeopleController extends AbstractController
{
    /**
     * @Route("/people", name="user_people")
     */
    public function index(Request $request, UserRepository $users): Response
    {
        $followings = $this->getUser()->getUserFollowings();
        $followingsArr = [];

        foreach ($followings as $following) {
            $followingsArr[] = $following->getFollowingUserId();
        }    

        return $this->render('post/people.html.twig', [
            'users' => $users->findByNotIn('id', [$this->getUser()->getId()]),
            'followings' => $followingsArr,
        ]);
    }

    /**
     * @Route("/{id}/follow", name="user_follow")
     */
    public function follow(Request $request, User $following): Response
    {
        $user = $this->getUser();
        $userFollowing = new UserFollowing();
        $userFollowing->setFollowingUserId($following->getId());
        $user->addUserFollowing($userFollowing);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('user_people');
    }

    /**
     * @Route("/{id}/unfollow", name="user_unfollow")
     */
    public function unfollow(Request $request, User $following, UserFollowingRepository $userFollowings): Response
    {
        $user = $this->getUser();
        $userFollowing = $userFollowings->findOneBy([
            'user_id' => $user->getId(),
            'following_user_id' => $following->getId()
        ]);
        
        $user->removeUserFollowing($userFollowing);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('user_people');
    }
}
