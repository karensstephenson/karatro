import { defineStore } from "pinia";

export const useGameStore = defineStore({
    id: "game",
    state: () => ({
        cards: [] as Card[],
        hand: [] as Card[],
        discards: [] as Card[],
        playedHands: [],
        totalPoints: 0,
        selectedCards: [] as String[],
        totalScore: 0,
        suitOrder: ["diamonds", "clubs", "hearts", "spades"],
    }),
    actions: {
        drawCards() {
            this.selectedCards = [];
            let card: any;
            let i = 0;
            const handSize = 10;

            while (i < handSize && this.hand.length < 10) {
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
            };
        },
        removeSelectedCardsFromHand() {
            this.hand = this.hand.filter(
                (card) =>
                    !this.selectedCards.some(
                        (selectedCard) => selectedCard.name === card.name
                    )
            );
            this.selectedCards = [];
            this.drawCards();
        },
        showScore() {
            const cardValues = this.selectedCards.map(
                (card: { value: number }) => card.value
            );
            this.totalScore = cardValues.reduce(
                (total, value) => total + value,
                0
            );
            this.removeSelectedCardsFromHand();
        },
        discardCards() {
            this.discards = this.discards.concat(this.selectedCards);
            this.removeSelectedCardsFromHand();
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
        },
        sortBySuit() {
            this.hand.sort(
                (a, b) => this.suitOrder.indexOf(a.suit) - this.suitOrder.indexOf(b.suit)
            );
        },
        sortByRank() {
            this.hand.sort((a, b) => b.rank - a.rank);
        }
    },
});
