<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ApiResource]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $balance = null;

    #[ORM\Column(length: 34)]
    private ?string $iban = null;

    #[ORM\Column]
    private ?bool $account_state = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\OneToMany(mappedBy: 'id_sender', targetEntity: Transaction::class)]
    private Collection $sent_transactions;

    #[ORM\OneToMany(mappedBy: 'id_receiver', targetEntity: Transaction::class)]
    private Collection $received_transactions;

    public function __construct()
    {
        $this->sent_transactions = new ArrayCollection();
        $this->received_transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function isAccountState(): ?bool
    {
        return $this->account_state;
    }

    public function setAccountState(bool $account_state): self
    {
        $this->account_state = $account_state;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getSentTransactions(): Collection
    {
        return $this->sent_transactions;
    }

    public function addSentTransaction(Transaction $sentTransaction): self
    {
        if (!$this->sent_transactions->contains($sentTransaction)) {
            $this->sent_transactions->add($sentTransaction);
            $sentTransaction->setIdSender($this);
        }

        return $this;
    }

    public function removeSentTransaction(Transaction $sentTransaction): self
    {
        if ($this->sent_transactions->removeElement($sentTransaction)) {
            // set the owning side to null (unless already changed)
            if ($sentTransaction->getIdSender() === $this) {
                $sentTransaction->setIdSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getReceivedTransactions(): Collection
    {
        return $this->received_transactions;
    }

    public function addReceivedTransaction(Transaction $receivedTransaction): self
    {
        if (!$this->received_transactions->contains($receivedTransaction)) {
            $this->received_transactions->add($receivedTransaction);
            $receivedTransaction->setIdReceiver($this);
        }

        return $this;
    }

    public function removeReceivedTransaction(Transaction $receivedTransaction): self
    {
        if ($this->received_transactions->removeElement($receivedTransaction)) {
            // set the owning side to null (unless already changed)
            if ($receivedTransaction->getIdReceiver() === $this) {
                $receivedTransaction->setIdReceiver(null);
            }
        }

        return $this;
    }
}
