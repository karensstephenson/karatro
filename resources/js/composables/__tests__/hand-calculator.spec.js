import { useHandCalculator } from '../hand-calculator'; 
import { describe, it, expect } from 'vitest';

const { getHandName } = useHandCalculator();

describe('Hand calculator test suite', () => {
  it('should return High Card when the only applicable card is that', () => {
        const highCardHand = [
            { value: 2, suit: 'hearts', rank: 2 },
            { value: 3, suit: 'diamonds', rank: 3 },
            { value: 4, suit: 'hearts', rank: 4 },
            { value: 5, suit: 'clubs', rank: 5 },
            { value: 7, suit: 'spaces', rank: 7 },
        ];

        const result = getHandName(highCardHand);
        expect(result).toEqual('High Card');
  });

    it('should return Pair when the only applicable card is that', () => {
            const pairHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 5, suit: 'clubs', rank: 5 },
                { value: 7, suit: 'spaces', rank: 7 },
            ];
    
            const result = getHandName(pairHand);
            expect(result).toEqual('Pair');
    });

    it('should return Two Pair when the only applicable card is that', () => {
            const twoPairHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 4, suit: 'clubs', rank: 4 },
            ];
    
            const result = getHandName(twoPairHand);
            expect(result).toEqual('Two Pair');
    });

    it('should return Three of a Kind when the only applicable card is that', () => {
            const threeOfAKindHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 2, suit: 'hearts', rank: 2 },
            ];
    
            const result = getHandName(threeOfAKindHand);
            expect(result).toEqual('Three of a Kind');
    });

    it('should return Straight when the only applicable card is that', () => {
            const straightHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 3, suit: 'diamonds', rank: 3 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 5, suit: 'clubs', rank: 5 },
                { value: 6, suit: 'spades', rank: 6 },
            ];
    
            const result = getHandName(straightHand);
            expect(result).toEqual('Straight');
    });

    it('should return Flush when the only applicable card is that', () => {
            const flushHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 6, suit: 'hearts', rank: 6 },
                { value: 8, suit: 'hearts', rank: 8 },
                { value: 10, suit: 'hearts', rank: 'J' },
            ];
    
            const result = getHandName(flushHand);
            expect(result).toEqual('Flush');
    });

    it('should return Full House when the only applicable card is that', () => {
            const fullHouseHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 4, suit: 'clubs', rank: 4 },
                { value: 4, suit: 'spaces', rank: 4 },
            ];
    
            const result = getHandName(fullHouseHand);
            expect(result).toEqual('Full House');
    });

    it('should return Four of a Kind when the only applicable card is that', () => {
            const fourOfAKindHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'clubs', rank: 2 },
            ];
    
            const result = getHandName(fourOfAKindHand);
            expect(result).toEqual('Four of a Kind');
    });

    it('should return Straight Flush when the only applicable card is that', () => {
            const straightFlushHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 3, suit: 'hearts', rank: 3 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 5, suit: 'hearts', rank: 5 },
                { value: 6, suit: 'hearts', rank: 6 },
            ];
    
            const result = getHandName(straightFlushHand);
            expect(result).toEqual('Straight Flush');
    });
});