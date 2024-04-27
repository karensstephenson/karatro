import { defineStore } from "pinia";
import { useHandCalculator, handDetails } from "../composables/hand-calculator";

export const useGameStore = defineStore({
    id: "game",
    state: () => ({
        cards: [] as Card[],
        hand: [] as Card[],
        discards: [] as Card[],
        playedCards: [] as Card[],
        playedHands: [],
        totalPoints: 0,
        selectedCards: [],
        chips: 0,
        handScore: 0,
        suitOrder: ["diamonds", "clubs", "hearts", "spades"],
        playerHand: "",
        showPlayerHand: "",
        multiplier: 0,
        currentCardIndex: -1,
        currentScore: 0,
        isPlayHandClicked: false,
    }),

    actions: {
        drawCards() {
            this.selectedCards = [];
            let card: any;
            let i = 0;
            const handSize = 8;

            while (i < handSize && this.hand.length < handSize) {
                card = this.pickRandomCard();
                this.hand.push(card);
                this.cards = this.cards.filter((chosenCard: any) => {
                    return chosenCard.name !== card.name;
                });
                i++;
            }
            this.hand.sort((a, b) => b.rank - a.rank);
        },
        pickRandomCard() {
            const randomNumber = Math.floor(Math.random() * this.cards.length);
            const randomCard = this.cards[randomNumber];
            return {
                name: randomCard.name,
                rank: randomCard.rank,
                value: randomCard.value,
                suit: randomCard.suit,
                inPlayedHand: false,
            };
        },
        removeSelectedCardsFromHand() {
            return new Promise<void>((resolve) => {
                let cardsPlayedThisHand = this.hand.filter((card) =>
                    this.selectedCards.some(
                        (selectedCard) => selectedCard.name === card.name
                    )
                );
                let handCardsLeft = this.hand.filter(
                    (card) =>
                        !this.selectedCards.some(
                            (selectedCard) => selectedCard.name === card.name
                        )
                );
                this.hand = handCardsLeft;
                this.playedCards = [
                    ...cardsPlayedThisHand,
                    ...this.playedCards,
                ];
                resolve();
            });
        },
        async showScore() {
            this.isPlayHandClicked = !this.isPlayHandClicked;
            await this.removeSelectedCardsFromHand();
            this.selectedCards.sort((a, b) => b.rank - a.rank);
            await this.displayValueWithDelay();
        },
        discardCards() {
            this.discards = this.discards.concat(this.selectedCards);
            this.removeSelectedCardsFromHand();
            this.clearDisplay();
            this.drawCards();
        },
        isSelected(index: number) {
            return this.selectedCards.includes(index);
        },
        toggleCard(index: number) {
            if (this.isSelected(index)) {
                this.selectedCards = this.selectedCards.filter(
                    (cardIndex) => cardIndex !== index
                );
            } else {
                if (this.selectedCards.length < 5) {
                    this.selectedCards.push(index);
                }
            }

            const handCalculator = useHandCalculator();
            this.playerHand = handCalculator.getHandName(this.selectedCards);

            this.showPlayerHand = handDetails[this.playerHand].name;
            this.multiplier = handDetails[this.playerHand].mult;
            this.chips = handDetails[this.playerHand].chips;
        },
        sortBySuit() {
            this.hand.sort(
                (a, b) =>
                    this.suitOrder.indexOf(a.suit) -
                    this.suitOrder.indexOf(b.suit)
            );
        },
        sortByRank() {
            this.hand.sort((a, b) => b.rank - a.rank);
        },
        clearDisplay() {
            this.showPlayerHand = "";
            this.multiplier = 0;
            this.chips = 0;
        },
        displayValueWithDelay() {
            return new Promise<void>((resolve) => {
                this.currentCardIndex = -1;
                this.currentScore = this.chips;
                
                const displayNextValue = () => {
                    if (this.currentCardIndex < this.selectedCards.length - 1) {
                        this.currentCardIndex++;
                        const currentCard =
                            this.selectedCards[this.currentCardIndex];
                        if (currentCard.inPlayedHand) {
                            this.currentScore += currentCard.value;
                            this.chips = this.currentScore;
                            setTimeout(displayNextValue, 1500);
                        } else {
                            displayNextValue();
                        }
                    } else {
                        this.isPlayHandClicked = !this.isPlayHandClicked;
                        this.drawCards();
                        this.calculateTotalPoints();
                        this.clearDisplay();
                        console.log(this.totalPoints);
                        resolve();
                    }
                };

                if (this.selectedCards.some((card) => card.inPlayedHand)) {
                    displayNextValue();
                }
            });
        },
        calculateTotalPoints() {
            this.totalPoints += this.multiplier * this.chips;
        },
    },
});
