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
    },
});
