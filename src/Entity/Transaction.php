<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ApiResource]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sent_transactions')]
    private ?Account $id_sender = null;

    #[ORM\ManyToOne(inversedBy: 'received_transactions')]
    private ?Account $id_receiver = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column]
    private ?bool $transaction_state = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $deposit_identity = null;

    #[ORM\Column(length: 15)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSender(): ?Account
    {
        return $this->id_sender;
    }

    public function setIdSender(?Account $id_sender): self
    {
        $this->id_sender = $id_sender;

        return $this;
    }

    public function getIdReceiver(): ?Account
    {
        return $this->id_receiver;
    }

    public function setIdReceiver(?Account $id_receiver): self
    {
        $this->id_receiver = $id_receiver;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function isTransactionState(): ?bool
    {
        return $this->transaction_state;
    }

    public function setTransactionState(bool $transaction_state): self
    {
        $this->transaction_state = $transaction_state;

        return $this;
    }

    public function getDepositIdentity(): ?string
    {
        return $this->deposit_identity;
    }

    public function setDepositIdentity(?string $deposit_identity): self
    {
        $this->deposit_identity = $deposit_identity;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
