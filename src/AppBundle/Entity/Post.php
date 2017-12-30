<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published", type="datetime")
     */
    private $published;


    /**
     * @var \string
     *
     * @ORM\Column(name="userid", type="string", length=255)
     */
    private $userid;

    /**
     * @var \string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Post
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Post
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }


     
    /**
     * Set userid
     *
     * @param \string $userid
     *
     * @return Post
     */
    public function setUserid($userid)
    {
        $this->userid= $userid;

        return $this;
    }


    /**
     * Get userid
     *
     * @return \string
     */
    public function getUserid()
    {
        return $this->userid;
    }
    
    
    /**
     * Set username
     *
     * @param \string $username
     *
     * @return Post
     */
    public function setUsername($username)
    {
        $this->username= $username;

        return $this;
    }


    /**
     * Get username
     *
     * @return \string
     */
    public function getUsername()
    {
        return $this->username;
    }





     /**
     * Is the given User the author of this Post?
     *
     * @return bool
     */
    public function isAuthor(User $user1=null)
    {
      return $user1 && $user1->getId() == $this->getUserid();
    }

    
}

